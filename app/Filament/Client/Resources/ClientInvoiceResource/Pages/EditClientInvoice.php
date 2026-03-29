<?php

namespace App\Filament\Client\Resources\ClientInvoiceResource\Pages;

use App\Filament\Client\Resources\ClientInvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientInvoice extends EditRecord
{
    protected static string $resource = ClientInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('preview')
                ->label('Preview')
                ->icon('heroicon-o-eye')
                ->url(fn (\App\Models\ClientInvoice $record): string => route('invoices.preview', $record))
                ->openUrlInNewTab(),
            Actions\Action::make('download')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->url(fn (\App\Models\ClientInvoice $record): string => route('invoices.download', $record))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
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