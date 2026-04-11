<?php

namespace App\Filament\Widgets;

use App\Models\Message;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Lead Baru', Lead::where('status', 'new')->count())
                ->description('Prospek belum di-follow up')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('success'),
            Stat::make('Pesan Masuk', Message::count())
                ->description('Inquiry dari website')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary'),
            Stat::make('Project Aktif', Project::where('status', 'progress')->count())
                ->description('Project sedang dikerjakan')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('warning'),
            Stat::make('Tagihan Belum Dibayar', Invoice::where('status', 'unpaid')->count())
                ->description('Menunggu pembayaran')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('danger'),
        ];
    }
}
