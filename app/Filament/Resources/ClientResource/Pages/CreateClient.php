<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Models\Client;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Throwable;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    protected ?string $generatedPassword = null;
    protected ?string $generatedOtp = null;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $credentials = Client::issueAccessCredentials($data['password'] ?? null);

        $this->generatedPassword = $credentials['plain_password'];
        $this->generatedOtp = $credentials['otp'];

        return array_merge($data, $credentials['attributes']);
    }

    protected function afterCreate(): void
    {
        try {
            $this->record->sendAccessEmail($this->generatedPassword);

            Notification::make()
                ->title('Email akses berhasil dikirim')
                ->body('Client menerima email berisi link login, password, dan kode OTP aktivasi.')
                ->success()
                ->send();
        } catch (Throwable $throwable) {
            Notification::make()
                ->title('Akun berhasil dibuat, tetapi email gagal dikirim')
                ->body('Periksa konfigurasi SMTP lalu kirim ulang akses client.')
                ->danger()
                ->send();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
