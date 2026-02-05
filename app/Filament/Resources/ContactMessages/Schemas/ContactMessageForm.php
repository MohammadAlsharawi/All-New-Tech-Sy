<?php

namespace App\Filament\Resources\ContactMessages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ContactMessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
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


                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
