<?php

namespace App\Filament\Resources\SiteVisits\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SiteVisitForm
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
                TextInput::make('post_code')
                    ->required(),
                TextInput::make('address')
                    ->required(),
                DatePicker::make('preferred_date')
                    ->required(),
                Select::make('property_type_id')
                    ->label('Property Type')
                    ->relationship('propertyType', 'name')
                    ->searchable()
                    ->preload()
                    ->reactive()       // مهم جداً
                    ->required(),

                Select::make('service_id')
                    ->label('Service')
                    ->options(function (callable $get) {

                        $propertyTypeId = $get('property_type_id');

                        if (! $propertyTypeId) {
                            return [];
                        }

                        return \App\Models\Service::where('property_type_id', $propertyTypeId)
                            ->pluck('title', 'id');
                    })
                    ->searchable()
                    ->required(),

                Select::make('preferred_time_id')
                    ->label('Preferred Time')
                    ->relationship('preferredTime', 'time')
                    ->searchable()
                    ->preload()
                    ->required(),

                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('confirmation')
                    ->required(),
            ]);
    }
}
