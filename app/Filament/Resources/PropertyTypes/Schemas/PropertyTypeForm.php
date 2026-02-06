<?php

namespace App\Filament\Resources\PropertyTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PropertyTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name.en')
                    ->label('Name (EN)')
                    ->required(),

                TextInput::make('name.ar')
                    ->label('Name (AR)')
                    ->required(),
            ]);
    }
}
