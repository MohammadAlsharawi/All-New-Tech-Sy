<?php

namespace App\Filament\Resources\BudgetRanges;

use App\Filament\Resources\BudgetRanges\Pages\CreateBudgetRange;
use App\Filament\Resources\BudgetRanges\Pages\EditBudgetRange;
use App\Filament\Resources\BudgetRanges\Pages\ListBudgetRanges;
use App\Filament\Resources\BudgetRanges\Pages\ViewBudgetRange;
use App\Filament\Resources\BudgetRanges\Schemas\BudgetRangeForm;
use App\Filament\Resources\BudgetRanges\Schemas\BudgetRangeInfolist;
use App\Filament\Resources\BudgetRanges\Tables\BudgetRangesTable;
use App\Models\BudgetRange;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BudgetRangeResource extends Resource
{
    protected static ?string $model = BudgetRange::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $recordTitleAttribute = 'BudgetRange';
    protected static string|UnitEnum|null $navigationGroup = 'Quote Request';
    protected static ?string $navigationLabel = 'Budget Range';

    public static function form(Schema $schema): Schema
    {
        return BudgetRangeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BudgetRangeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BudgetRangesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBudgetRanges::route('/'),
            'create' => CreateBudgetRange::route('/create'),
            'view' => ViewBudgetRange::route('/{record}'),
            'edit' => EditBudgetRange::route('/{record}/edit'),
        ];
    }
}
