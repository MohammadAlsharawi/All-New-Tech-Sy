<?php

namespace App\Filament\Resources\QuoteRequests\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuoteRequestForm
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
                Select::make('property_type_id')
                    ->label('Property Type')
                    ->relationship('propertyType', 'name')
                    ->searchable()
                    ->preload()
                    ->reactive()
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

                Select::make('preferred_contact_method_id')
                    ->label('Preferred Contact Method')
                    ->relationship('preferredContactMethod', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Textarea::make('requirements')
                    ->required()
                    ->columnSpanFull(),
                Select::make('budget_range_id')
                    ->label('Budget Range')
                    ->relationship('budgetRange', 'range')
                    ->searchable()
                    ->preload()
                    ->required(),

                FileUpload::make('file')
                    ->disk('public')
                    ->directory('Quote_files')
                    ->acceptedFileTypes(['application/pdf'])
                    ->required()
                    ->downloadable()
                    ->openable(),
                Toggle::make('confirmation')
                    ->required(),
            ]);
    }
}
