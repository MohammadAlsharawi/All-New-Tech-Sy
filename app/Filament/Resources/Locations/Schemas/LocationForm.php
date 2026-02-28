<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Hidden;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Branch Name')
                    ->required()
                    ->readOnly(),
                Hidden::make('latitude')
                    ->required(),
                Hidden::make('longitude')
                    ->required(),
                Hidden::make('address')
                    ->required(),
                Toggle::make('is_main')
                    ->required()
                    ->label('Main Branch'),
                Field::make('map')
                    ->view('filament.components.map-picker')
                    ->label('Pick Location')
                    ->columnSpanFull(),
            ]);
    }
}
