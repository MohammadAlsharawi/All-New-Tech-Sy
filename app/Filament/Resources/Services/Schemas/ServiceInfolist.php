<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')
                    ->square()
                    ->size(300)
                    ->disk('public'),
                TextEntry::make('title'),
                TextEntry::make('description'),
                TextEntry::make('propertyType.name')
                    ->label('Property Type'),
                RepeatableEntry::make('advantages')
                    ->label('Advantages')
                    ->schema([
                        TextEntry::make('item')
                            ->label('')
                            ->formatStateUsing(fn ($state) => "• " . $state),
                    ])
                    ->columnSpanFull(),

                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
