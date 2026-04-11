<?php

namespace App\Filament\Resources\ClientInvoiceResource\Pages;

use App\Filament\Resources\ClientInvoiceResource;
use App\Models\ClientInvoice;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientInvoice extends EditRecord
{
    protected static string $resource = ClientInvoiceResource::class;

    public function getTitle(): string
    {
        return 'Ubah Tagihan';
    }

    public function getBreadcrumb(): string
    {
        return 'Ubah';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('preview')
                ->label('Pratinjau')
                ->icon('heroicon-o-eye')
                ->url(fn (ClientInvoice $record): string => route('invoices.preview', $record))
                ->openUrlInNewTab(),
            Actions\Action::make('download')
                ->label('Unduh PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn (ClientInvoice $record): string => route('invoices.download', $record))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }

    protected function afterSave(): void
    {
        $this->record->recalculateTotals();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
