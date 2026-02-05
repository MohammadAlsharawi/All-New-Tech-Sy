<?php

namespace App\Filament\Resources\BudgetRanges\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BudgetRangeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('range')
                    ->required(),
            ]);
    }
}
