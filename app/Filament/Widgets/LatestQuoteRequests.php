<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\QuoteRequests\QuoteRequestResource;
use App\Models\QuoteRequest;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestQuoteRequests extends BaseWidget
{
    protected static bool $isLazy = false;

    protected static ?int $sort = 2;

    protected static ?string $heading = 'Recent Quote Requests from Homepage';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(QuoteRequest::query()->latest())
            ->columns([
                TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->description(fn (QuoteRequest $record): string => $record->created_at?->format('M d, Y · g:i A') ?? '')
                    ->sortable(),
                TextColumn::make('full_name')
                    ->label('Client Name')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('city')
                    ->label('City / Location')
                    ->placeholder('Addis Ababa')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Phone / WhatsApp')
                    ->copyable(),
                TextColumn::make('project_type')
                    ->label('Project Type')
                    ->badge(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        QuoteRequest::STATUS_NEW => 'warning',
                        QuoteRequest::STATUS_CONTACTED => 'info',
                        QuoteRequest::STATUS_IN_PROGRESS => 'primary',
                        QuoteRequest::STATUS_COMPLETED => 'success',
                        QuoteRequest::STATUS_ARCHIVED => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => QuoteRequest::STATUSES[$state] ?? ucfirst($state)),
            ])
            ->actions([
                Action::make('view')
                    ->label('Review')
                    ->icon('heroicon-o-eye')
                    ->url(fn (QuoteRequest $record): string => QuoteRequestResource::getUrl('view', ['record' => $record])),
            ])
            ->paginated([5, 10]);
    }
}
