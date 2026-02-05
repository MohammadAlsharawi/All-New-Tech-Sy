<?php

namespace App\Filament\Resources\LatestNews\Pages;

use App\Filament\Resources\LatestNews\LatestNewsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLatestNews extends ViewRecord
{
    protected static string $resource = LatestNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
