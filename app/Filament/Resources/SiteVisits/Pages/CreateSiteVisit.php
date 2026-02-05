<?php

namespace App\Filament\Resources\SiteVisits\Pages;

use App\Filament\Resources\SiteVisits\SiteVisitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSiteVisit extends CreateRecord
{
    protected static string $resource = SiteVisitResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
