<?php

namespace App\Filament\Resources\SiteVisits\Pages;

use App\Filament\Resources\SiteVisits\SiteVisitResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSiteVisit extends EditRecord
{
    protected static string $resource = SiteVisitResource::class;

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
