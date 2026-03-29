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
            Stat::make('Total Invoices', $totalInvoices)
                ->description('All your created invoices')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
            Stat::make('Total Paid', 'Rp ' . number_format($totalPaid, 0, ',', '.'))
                ->description('Total amount from paid invoices')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Pending Payment', 'Rp ' . number_format($totalUnpaid, 0, ',', '.'))
                ->description('Total outstanding balance')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
        ];
    }
}
