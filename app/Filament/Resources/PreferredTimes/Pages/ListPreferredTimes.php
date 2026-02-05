<?php

namespace App\Filament\Resources\PreferredTimes\Pages;

use App\Filament\Resources\PreferredTimes\PreferredTimeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPreferredTimes extends ListRecords
{
    protected static string $resource = PreferredTimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
