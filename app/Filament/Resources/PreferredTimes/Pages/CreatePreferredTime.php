<?php

namespace App\Filament\Resources\PreferredTimes\Pages;

use App\Filament\Resources\PreferredTimes\PreferredTimeResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePreferredTime extends CreateRecord
{
    protected static string $resource = PreferredTimeResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
