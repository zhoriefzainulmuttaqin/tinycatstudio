<?php

namespace App\Filament\Client\Widgets;

use App\Models\ClientInvoice;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ClientStatsWidget extends BaseWidget
{
    protected static ?int $sort = -2;

    protected function getStats(): array
    {
        $clientId = auth()->id();
        $user = auth()->user();

        $totalInvoices = ClientInvoice::where('client_id', $clientId)->count();
        $totalPaid = ClientInvoice::where('client_id', $clientId)->where('status', 'paid')->sum('total_amount');

        $subscriptionStatus = 'Seumur Hidup';
        $subDesc = 'Akses tanpa batas';
        $subColor = 'success';

        if ($user->valid_until) {
            $daysLeft = now()->diffInDays($user->valid_until, false);

            if ($daysLeft > 0) {
                $subscriptionStatus = $daysLeft . ' hari lagi';
                $subDesc = 'Aktif sampai ' . $user->valid_until->format('d M Y');
                $subColor = $daysLeft <= 7 ? 'warning' : 'success';
            } else {
                $subscriptionStatus = 'Berakhir';
                $subDesc = 'Silakan perpanjang langganan Anda';
                $subColor = 'danger';
            }
        }

        return [
            Stat::make('Langganan SaaS', $subscriptionStatus)
                ->description($subDesc)
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color($subColor),
            Stat::make('Tagihan Diterbitkan', $totalInvoices)
                ->description('Total tagihan yang dikirim ke pelanggan Anda')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalPaid, 0, ',', '.'))
                ->description('Pemasukan dari tagihan yang sudah lunas')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}
