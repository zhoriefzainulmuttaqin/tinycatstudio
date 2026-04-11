<?php

namespace App\Filament\Client\Resources\ClientInvoiceResource\Pages;

use App\Filament\Client\Resources\ClientInvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClientInvoices extends ListRecords
{
    protected static string $resource = ClientInvoiceResource::class;

    public function getTitle(): string
    {
        return 'Tagihan Saya';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Buat Tagihan'),
        ];
    }
}
