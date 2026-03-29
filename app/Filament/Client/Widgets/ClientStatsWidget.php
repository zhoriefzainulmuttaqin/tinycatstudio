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
        $user = auth()->user();
        
        $totalInvoices = ClientInvoice::where('client_id', $clientId)->count();
        $totalPaid = ClientInvoice::where('client_id', $clientId)->where('status', 'paid')->sum('total_amount');
        
        $subscriptionStatus = 'Lifetime';
        $subDesc = 'Unlimited Access';
        $subColor = 'success';
        
        if ($user->valid_until) {
            $daysLeft = now()->diffInDays($user->valid_until, false);
            if ($daysLeft > 0) {
                $subscriptionStatus = $daysLeft . ' Days Left';
                $subDesc = 'Valid until ' . $user->valid_until->format('d M Y');
                $subColor = $daysLeft <= 7 ? 'warning' : 'success';
            } else {
                $subscriptionStatus = 'Expired';
                $subDesc = 'Please renew your subscription';
                $subColor = 'danger';
            }
        }

        return [
            Stat::make('SaaS Subscription', $subscriptionStatus)
                ->description($subDesc)
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color($subColor),
            Stat::make('Invoices Issued', $totalInvoices)
                ->description('Total invoices sent to your clients')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
            Stat::make('Total Revenue', 'Rp ' . number_format($totalPaid, 0, ',', '.'))
                ->description('Income from paid invoices')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}
