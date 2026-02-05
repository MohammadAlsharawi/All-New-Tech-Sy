<?php

namespace App\Filament\Resources\PreferredTimes\Pages;

use App\Filament\Resources\PreferredTimes\PreferredTimeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPreferredTime extends ViewRecord
{
    protected static string $resource = PreferredTimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
