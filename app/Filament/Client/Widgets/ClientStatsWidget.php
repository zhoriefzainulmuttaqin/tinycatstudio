<?php

namespace App\Filament\Client\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ClientInvoice;

class ClientStatsWidget extends BaseWidget
{
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        $clientId = auth()->id();
        
        $totalInvoices = ClientInvoice::where('client_id', $clientId)->count();
        $totalPaid = ClientInvoice::where('client_id', $clientId)->where('status', 'paid')->sum('total_amount');
        $totalUnpaid = ClientInvoice::where('client_id', $clientId)->whereIn('status', ['draft', 'deposit', 'overdue'])->sum('total_amount');

        return [
            Stat::make('Invoices Issued', $totalInvoices)
                ->description('Total invoices sent to your clients')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
            Stat::make('Total Revenue', 'Rp ' . number_format($totalPaid, 0, ',', '.'))
                ->description('Income from paid invoices')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Outstanding Balance', 'Rp ' . number_format($totalUnpaid, 0, ',', '.'))
                ->description('Amount owed by your clients')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
