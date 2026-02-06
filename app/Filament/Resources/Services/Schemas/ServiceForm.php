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
                TextInput::make('title.en')
                    ->label('Title (EN)')
                    ->required(),

                TextInput::make('title.ar')
                    ->label('Title (AR)')
                    ->required(),

                Textarea::make('description.en')
                    ->label('Description (EN)')
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('description.ar')
                    ->label('Description (AR)')
                    ->required()
                    ->columnSpanFull(),

            Repeater::make('advantages')
                ->label('Advantages')
                ->schema([
                    TextInput::make('en')
                        ->label('English')
                        ->required(),
                    TextInput::make('ar')
                        ->label('Arabic')
                        ->required(),
                ])
                ->columnSpanFull()
                ->minItems(1),

                Select::make('property_type_id')
                    ->label('Property Type')
                    ->relationship('propertyType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

            ]);
    }
}
