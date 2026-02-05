<?php

namespace App\Filament\Resources\PreferredTimes\Pages;

use App\Filament\Resources\PreferredTimes\PreferredTimeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPreferredTime extends EditRecord
{
    protected static string $resource = PreferredTimeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
