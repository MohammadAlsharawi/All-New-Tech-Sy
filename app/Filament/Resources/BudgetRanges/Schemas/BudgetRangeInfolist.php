<?php

namespace App\Filament\Resources\BudgetRanges\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BudgetRangeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('range'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
