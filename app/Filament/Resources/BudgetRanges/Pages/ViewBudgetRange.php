<?php

namespace App\Filament\Resources\BudgetRanges\Pages;

use App\Filament\Resources\BudgetRanges\BudgetRangeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBudgetRange extends ViewRecord
{
    protected static string $resource = BudgetRangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
