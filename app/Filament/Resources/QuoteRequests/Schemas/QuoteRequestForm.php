<?php

namespace App\Filament\Resources\QuoteRequests\Schemas;

use App\Models\QuoteRequest;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuoteRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Inquiry & Customer Details')
                    ->description('Client contact information and submitted project requirements')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('full_name')
                                ->label('Full Name')
                                ->required(),
                            TextInput::make('company')
                                ->label('Company / Organization'),
                            TextInput::make('phone')
                                ->label('Phone / WhatsApp')
                                ->tel()
                                ->required(),
                            TextInput::make('email')
                                ->label('Email Address')
                                ->email(),
                            TextInput::make('city')
                                ->label('City / Location')
                                ->placeholder('e.g. Addis Ababa, Hawassa'),
                            Select::make('project_type')
                                ->label('Project Type')
                                ->options([
                                    'Private Villa' => 'Private Villa',
                                    'Apartment / Real Estate' => 'Apartment / Real Estate',
                                    'Hotel / Resort' => 'Hotel / Resort',
                                    'Commercial Office' => 'Commercial Office',
                                    'Showroom / Retail' => 'Showroom / Retail',
                                    'Other' => 'Other',
                                ]),
                            Select::make('status')
                                ->label('Inquiry Status')
                                ->options(QuoteRequest::STATUSES)
                                ->default(QuoteRequest::STATUS_NEW)
                                ->required(),
                        ]),
                        Textarea::make('message')
                            ->label('Client Requirements / Message')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Internal Notes & Follow-up')
                    ->description('Private notes for Adorn Trading PLC sales and project managers')
                    ->schema([
                        Textarea::make('admin_notes')
                            ->label('Internal Notes')
                            ->placeholder('e.g., Called client on Sep 26, requested 3D drawings for kitchen and wardrobe packages, BOQ estimate sent...')
                            ->rows(3)
                            ->columnSpanFull(),
                        Grid::make(2)->schema([
                            Placeholder::make('created_at')
                                ->label('Received')
                                ->content(fn (?QuoteRequest $record): string => $record?->created_at ? $record->created_at->diffForHumans() . ' (' . $record->created_at->format('M d, Y · g:i A') . ')' : '—'),
                            Placeholder::make('updated_at')
                                ->label('Last Activity')
                                ->content(fn (?QuoteRequest $record): string => $record?->updated_at ? $record->updated_at->diffForHumans() . ' (' . $record->updated_at->format('M d, Y · g:i A') . ')' : '—'),
                        ]),
                    ]),
            ]);
    }
}
