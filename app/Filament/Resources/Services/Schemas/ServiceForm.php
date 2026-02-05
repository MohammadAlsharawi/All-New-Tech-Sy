<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('services_image')
                    ->maxSize(5000)
                    ->imagePreviewHeight('250')
                    ->downloadable()
                    ->openable(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Repeater::make('advantages')
                    ->label('Advantages')
                    ->schema([
                        TextInput::make('item')
                            ->label('Advantage')
                            ->required(),
                    ])
                    ->minItems(1)
                    ->defaultItems(1)
                    ->addActionLabel('Add Advantage')
                    ->columnSpanFull(),

                Select::make('property_type_id')
                    ->label('Property Type')
                    ->relationship('propertyType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

            ]);
    }
}
