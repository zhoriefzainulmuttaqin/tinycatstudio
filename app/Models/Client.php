<?php

namespace App\Models;

use App\Mail\ClientActivationOtp;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Client extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $fillable = [
        'name',
        'company_name',
        'email',
        'email_verified_at',
        'password',
        'phone',
        'address',
        'logo_url',
        'theme_color',
        'signature_url',
        'valid_until',
        'is_active',
        'activation_otp',
        'activation_otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'valid_until' => 'date',
            'is_active' => 'boolean',
            'activation_otp_expires_at' => 'datetime',
        ];
    }

    public static function issueAccessCredentials(?string $password = null): array
    {
        $plainPassword = filled($password) ? $password : Str::random(10);
        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        return [
            'plain_password' => $plainPassword,
            'otp' => $otp,
            'attributes' => [
                'password' => $plainPassword,
                'activation_otp' => $otp,
                'activation_otp_expires_at' => now()->addMinutes(15),
                'email_verified_at' => null,
            ],
        ];
    }

    public function refreshAccess(?string $password = null): array
    {
        $credentials = static::issueAccessCredentials($password);

        $this->update($credentials['attributes']);

        return $credentials;
    }

    public function sendAccessEmail(?string $password = null): void
    {
        $client = $this->fresh();

        Mail::to($client->email)->send(
            new ClientActivationOtp($client, (string) $client->activation_otp, $password)
        );
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === 'client';
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
