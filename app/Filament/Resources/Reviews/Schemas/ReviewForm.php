<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('user_image')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('user_image')
                    ->maxSize(5000)
                    ->imagePreviewHeight('250')
                    ->downloadable()
                    ->openable(),
                TextInput::make('rating')
                    ->required()
                    ->numeric(),
                TextInput::make('description.en')
                    ->label('Description (EN)')
                    ->required(),

                TextInput::make('description.ar')
                    ->label('Description (AR)')
                    ->required(),
            ]);
    }
}
