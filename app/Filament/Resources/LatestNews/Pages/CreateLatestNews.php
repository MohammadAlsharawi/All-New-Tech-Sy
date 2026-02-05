<?php

namespace App\Filament\Resources\LatestNews\Pages;

use App\Filament\Resources\LatestNews\LatestNewsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLatestNews extends CreateRecord
{
    protected static string $resource = LatestNewsResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
