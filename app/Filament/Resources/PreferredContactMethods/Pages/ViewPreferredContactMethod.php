<?php

namespace App\Filament\Resources\PreferredContactMethods\Pages;

use App\Filament\Resources\PreferredContactMethods\PreferredContactMethodResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPreferredContactMethod extends ViewRecord
{
    protected static string $resource = PreferredContactMethodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
