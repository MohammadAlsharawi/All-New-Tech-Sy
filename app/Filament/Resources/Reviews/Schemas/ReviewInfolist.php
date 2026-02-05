<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReviewInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('user_image')
                    ->square()
                    ->size(300)
                    ->disk('public'),
                TextEntry::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(function ($state) {
                        $stars = '';
                        for ($i = 1; $i <= 5; $i++) {
                            $stars .= $i <= $state ? '⭐' : '☆';
                        }
                        return $stars;
                    })
                    ->html(),

                TextEntry::make('description'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
