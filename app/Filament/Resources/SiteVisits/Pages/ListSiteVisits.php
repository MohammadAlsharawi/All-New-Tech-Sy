<?php

namespace App\Filament\Resources\SiteVisits\Pages;

use App\Filament\Resources\SiteVisits\SiteVisitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiteVisits extends ListRecords
{
    protected static string $resource = SiteVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
