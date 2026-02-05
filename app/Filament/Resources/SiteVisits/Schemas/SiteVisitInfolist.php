<?php

namespace App\Filament\Resources\SiteVisits\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SiteVisitInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('first_name'),
                TextEntry::make('last_name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('phone'),
                TextEntry::make('post_code'),
                TextEntry::make('address'),
                TextEntry::make('propertyType.name')
                    ->label('Property Type')
                    ->placeholder('-'),

                TextEntry::make('service.title')
                    ->label('Service')
                    ->placeholder('-'),

                TextEntry::make('preferredTime.time')
                    ->label('Preferred Time')
                    ->placeholder('-'),

                TextEntry::make('preferred_date')
                    ->date(),
                TextEntry::make('notes'),
                IconEntry::make('confirmation')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
