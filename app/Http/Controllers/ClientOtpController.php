<?php

namespace App\Http\Controllers;

use App\Mail\ClientActivationOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ClientOtpController extends Controller
{
    public function show()
    {
        $client = Auth::guard('client')->user();

        if (! $client) {
            return redirect()->route('filament.client.auth.login');
        }

        if ($client->email_verified_at) {
            return redirect()->route('filament.client.pages.dashboard');
        }

        return view('client.verify-otp', [
            'client' => $client,
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:6'],
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.digits' => 'Kode OTP harus terdiri dari 6 digit.',
        ]);

        $client = Auth::guard('client')->user();

        if (! $client) {
            return redirect()->route('filament.client.auth.login');
        }

        if (blank($client->activation_otp)) {
            return back()->withErrors([
                'otp' => 'Kode OTP belum tersedia. Silakan kirim ulang OTP.',
            ]);
        }

        if ($client->activation_otp_expires_at?->isPast()) {
            return back()->withErrors([
                'otp' => 'Kode OTP sudah kedaluwarsa. Silakan kirim ulang OTP.',
            ]);
        }

        if (! hash_equals((string) $client->activation_otp, (string) $request->string('otp'))) {
            return back()->withErrors([
                'otp' => 'Kode OTP yang Anda masukkan tidak valid.',
            ]);
        }

        $client->update([
            'activation_otp' => null,
            'activation_otp_expires_at' => null,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('filament.client.pages.dashboard')->with('status', 'Akun Anda berhasil diaktifkan.');
    }

    public function resend(Request $request)
    {
        $client = Auth::guard('client')->user();

        if (! $client) {
            return redirect()->route('filament.client.auth.login');
        }

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $client->update([
            'activation_otp' => $otp,
            'activation_otp_expires_at' => now()->addMinutes(15),
        ]);

        Mail::to($client->email)->send(new ClientActivationOtp($client->fresh(), $otp));

        return back()->with('status', 'Kode OTP baru sudah dikirim ke email Anda.');
    }
}
