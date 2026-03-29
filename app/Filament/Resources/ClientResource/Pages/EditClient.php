<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('resend_access_email')
                ->label('Kirim Ulang Akses')
                ->icon('heroicon-o-envelope')
                ->color('info')
                ->form(ClientResource::getAccessEmailFormSchema())
                ->modalHeading('Kirim ulang email akses client')
                ->modalDescription('Password client akan direset dan OTP baru akan dikirim ke email client ini.')
                ->modalSubmitActionLabel('Kirim email akses')
                ->action(fn (array $data) => ClientResource::resendAccessEmail($this->record, $data)),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
