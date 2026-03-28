<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check() && Auth::user()?->isAdmin()) {
            return redirect()->route('dashboard');
        }

        return view('admin.auth.login', [
            'siteSettings' => $this->siteSettings(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (Auth::check() && Auth::user()?->isAdmin()) {
            return redirect()->route('dashboard');
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'admin',
        ], $request->boolean('remember'))) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password admin tidak valid.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))
            ->with('success', 'Berhasil masuk ke area admin.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Anda telah keluar dari area admin.');
    }

    /**
     * @return array<string, string>
     */
    private function siteSettings(): array
    {
        return array_merge([
            'site_name' => 'TinyCatStudio',
            'site_tagline' => 'Software house premium untuk website, aplikasi mobile, branding, desain visual, dan digital ads.',
        ], Setting::query()->pluck('value', 'key')->all());
    }
}
