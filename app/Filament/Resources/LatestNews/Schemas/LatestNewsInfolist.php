<?php

namespace App\Filament\Resources\LatestNews\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class LatestNewsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')
                ->square()
                ->size(300)
                ->disk('public'),
                TextEntry::make('title')
                    ->label(__('Title'))
                    ->getStateUsing(fn ($record) =>
                        $record->getTranslation('title', app()->getLocale())
                    ),
                TextEntry::make('content')
                    ->label(__('Content'))
                    ->getStateUsing(fn ($record) =>
                        $record->getTranslation('content', app()->getLocale())
                    ),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
