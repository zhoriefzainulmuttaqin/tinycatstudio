<?php

namespace App\Filament\Resources\ClientInvoiceResource\Pages;

use App\Filament\Resources\ClientInvoiceResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClientInvoice extends CreateRecord
{
    protected static string $resource = ClientInvoiceResource::class;

    public function getTitle(): string
    {
        return 'Buat Tagihan';
    }

    public function getBreadcrumb(): string
    {
        return 'Buat';
    }

    protected function afterCreate(): void
    {
        $this->record->recalculateTotals();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
