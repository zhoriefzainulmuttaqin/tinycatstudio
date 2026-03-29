<?php

namespace App\Filament\Resources\ClientInvoiceResource\Pages;

use App\Filament\Resources\ClientInvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClientInvoices extends ListRecords
{
    protected static string $resource = ClientInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
