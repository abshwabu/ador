<?php

namespace App\Filament\Widgets;

use App\Models\QuoteRequest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class QuoteRequestStats extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $newCount = QuoteRequest::where('status', QuoteRequest::STATUS_NEW)->count();
        $totalCount = QuoteRequest::count();
        $inProgressCount = QuoteRequest::whereIn('status', [QuoteRequest::STATUS_CONTACTED, QuoteRequest::STATUS_IN_PROGRESS])->count();
        $completedCount = QuoteRequest::where('status', QuoteRequest::STATUS_COMPLETED)->count();

        return [
            Stat::make('New Inquiries', $newCount)
                ->description('Awaiting initial review')
                ->descriptionIcon('heroicon-m-inbox-arrow-down')
                ->color($newCount > 0 ? 'warning' : 'gray'),

            Stat::make('In Follow-Up', $inProgressCount)
                ->description('Contacted & active quotes')
                ->descriptionIcon('heroicon-m-chat-bubble-bottom-center-text')
                ->color('info'),

            Stat::make('Total Inquiries', $totalCount)
                ->description('All-time website consultation requests')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary'),
        ];
    }
}
