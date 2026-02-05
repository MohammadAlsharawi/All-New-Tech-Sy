<?php

namespace App\Filament\Resources\LatestNews\Pages;

use App\Filament\Resources\LatestNews\LatestNewsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLatestNews extends ListRecords
{
    protected static string $resource = LatestNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
