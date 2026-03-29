<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientActivationOtp extends Mailable
{
    use Queueable, SerializesModels;

    public Client $client;
    public string $otp;
    public ?string $password;
    public string $loginUrl;
    public int $otpExpiresInMinutes = 15;

    public function __construct(Client $client, string $otp, ?string $password = null)
    {
        $this->client = $client;
        $this->otp = $otp;
        $this->password = $password;
        $this->loginUrl = route('filament.client.auth.login');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Aktivasi akun client TinyCat Invoicing',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.client_activation_otp',
        );
    }
}
