<?php

namespace App\Filament\Resources\Companies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CompanyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name.en')
                    ->label('Company name (EN)')
                    ->required(),
                TextInput::make('name.ar')
                    ->label('Company name (AR)')
                    ->required(),
                FileUpload::make('logo')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('logos')
                    ->maxSize(5000)
                    ->imagePreviewHeight('250')
                    ->downloadable()
                    ->openable(),

                TextInput::make('priority')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
