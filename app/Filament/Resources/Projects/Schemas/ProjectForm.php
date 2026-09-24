<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Details')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->required()
                                ->unique(ignoreRecord: true),
                            TextInput::make('client'),
                            TextInput::make('location'),
                            TextInput::make('year'),
                            TextInput::make('category')
                                ->placeholder('e.g. Residential Villa, Commercial Office'),
                        ]),
                        Textarea::make('excerpt')
                            ->rows(2)
                            ->columnSpanFull(),
                        Textarea::make('body')
                            ->rows(5)
                            ->columnSpanFull(),
                        FileUpload::make('cover_image')
                            ->image()
                            ->disk('public')
                            ->directory('projects')
                            ->columnSpanFull(),
                        Grid::make(3)->schema([
                            TextInput::make('sort_order')
                                ->required()
                                ->numeric()
                                ->default(0),
                            Toggle::make('is_active')
                                ->default(true)
                                ->required(),
                            Toggle::make('featured')
                                ->default(false)
                                ->required(),
                        ]),
                    ]),

                Section::make('Gallery Images')
                    ->description('Add and organize project portfolio photos')
                    ->schema([
                        Repeater::make('images')
                            ->relationship('images')
                            ->schema([
                                FileUpload::make('image_path')
                                    ->label('Photo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('projects')
                                    ->required(),
                                TextInput::make('caption')
                                    ->label('Caption'),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ])
                            ->columns(3)
                            ->collapsible()
                            ->defaultItems(0)
                            ->addActionLabel('Add Gallery Photo'),
                    ]),
            ]);
    }
}
