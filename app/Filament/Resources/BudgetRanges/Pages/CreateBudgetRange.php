<?php

namespace App\Filament\Resources\BudgetRanges\Pages;

use App\Filament\Resources\BudgetRanges\BudgetRangeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBudgetRange extends CreateRecord
{
    protected static string $resource = BudgetRangeResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
