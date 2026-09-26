<?php

namespace App\Filament\Resources\QuoteRequests\Tables;

use App\Models\QuoteRequest;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class QuoteRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
                TextColumn::make('full_name')
                    ->label('Client Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('company')
                    ->label('Company')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone')
                    ->label('Phone / WhatsApp')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Phone copied to clipboard'),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('project_type')
                    ->label('Project Type')
                    ->badge()
                    ->searchable(),
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
                TextColumn::make('message')
                    ->label('Requirements Snippet')
                    ->limit(45)
                    ->tooltip(fn (QuoteRequest $record): string => $record->message ?? '')
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(QuoteRequest::STATUSES),
                SelectFilter::make('project_type')
                    ->label('Project Type')
                    ->options([
                        'Private Villa' => 'Private Villa',
                        'Apartment / Real Estate' => 'Apartment / Real Estate',
                        'Hotel / Resort' => 'Hotel / Resort',
                        'Commercial Office' => 'Commercial Office',
                        'Showroom / Retail' => 'Showroom / Retail',
                        'Other' => 'Other',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('mark_contacted')
                    ->label('Mark Contacted')
                    ->icon('heroicon-o-check-circle')
                    ->color('info')
                    ->visible(fn (QuoteRequest $record): bool => $record->status === QuoteRequest::STATUS_NEW)
                    ->action(fn (QuoteRequest $record) => $record->update(['status' => QuoteRequest::STATUS_CONTACTED])),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
