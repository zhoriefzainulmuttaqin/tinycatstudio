<?php

namespace App\Filament\Client\Resources\ClientCustomerResource\Pages;

use App\Filament\Client\Resources\ClientCustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClientCustomers extends ListRecords
{
    protected static string $resource = ClientCustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
