<?php

namespace App\Filament\Resources\LatestNews\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LatestNewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->required()
                    ->image()
                    ->disk('public')
                    ->directory('photos')
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
                TextInput::make('content.en')
                    ->label('Content (EN)')
                    ->required(),

                TextInput::make('content.ar')
                    ->label('Content (AR)')
                    ->required(),
            ]);
    }
}
