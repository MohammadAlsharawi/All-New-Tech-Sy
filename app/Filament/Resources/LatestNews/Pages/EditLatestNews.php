<?php

namespace App\Filament\Resources\LatestNews\Pages;

use App\Filament\Resources\LatestNews\LatestNewsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLatestNews extends EditRecord
{
    protected static string $resource = LatestNewsResource::class;

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
