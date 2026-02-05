<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),

                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),

                // ========================
                // Challenges - JSON Points
                // ========================
                Repeater::make('challenges')
                    ->label('Challenges')
                    ->schema([
                        TextInput::make('item')
                            ->label('Challenge Point')
                            ->required(),
                    ])
                    ->minItems(1)
                    ->defaultItems(1)
                    ->columnSpanFull()
                    ->required(),

                // ========================
                // Solutions - JSON Points
                // ========================
                Repeater::make('solutions')
                    ->label('Solutions')
                    ->schema([
                        TextInput::make('item')
                            ->label('Solution Point')
                            ->required(),
                    ])
                    ->minItems(1)
                    ->defaultItems(1)
                    ->columnSpanFull()
                    ->required(),

                // ========================
                // Relationships with name
                // ========================

                Select::make('property_type_id')
                    ->label('Property Type')
                    ->relationship('propertyType', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (callable $set) => $set('service_id', null)),

                Select::make('service_id')
                    ->label('Service')
                    ->relationship('service', 'title', function ($query, callable $get) {
                        return $query->where('property_type_id', $get('property_type_id'));
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                    
                // ========================
                // Media Library Upload
                // ========================

                SpatieMediaLibraryFileUpload::make('main_image')
                    ->label('Main Image')
                    ->collection('main')
                    ->disk('public')
                    ->image()
                    ->maxFiles(1)
                    ->required()
                    ->maxSize(5000)
                    ->imagePreviewHeight('300')
                    ->downloadable()
                    ->openable(),

                SpatieMediaLibraryFileUpload::make('secondary_images')
                    ->label('Secondary Images')
                    ->collection('secondary')
                    ->disk('public')
                    ->image()
                    ->multiple()
                    ->minFiles(1)
                    ->required()
                    ->maxSize(5000)
                    ->imagePreviewHeight('300')
                    ->downloadable()
                    ->openable(),

                SpatieMediaLibraryFileUpload::make('other_images')
                    ->label('other Images')
                    ->collection('other')
                    ->disk('public')
                    ->image()
                    ->multiple()
                    ->minFiles(1)
                    ->required()
                    ->maxSize(5000)
                    ->imagePreviewHeight('300')
                    ->downloadable()
                    ->openable(),
            ]);
    }
}
