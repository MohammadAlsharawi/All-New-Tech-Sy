<?php

namespace App\Filament\Resources\SiteVisits;

use App\Filament\Resources\SiteVisits\Pages\CreateSiteVisit;
use App\Filament\Resources\SiteVisits\Pages\EditSiteVisit;
use App\Filament\Resources\SiteVisits\Pages\ListSiteVisits;
use App\Filament\Resources\SiteVisits\Pages\ViewSiteVisit;
use App\Filament\Resources\SiteVisits\Schemas\SiteVisitForm;
use App\Filament\Resources\SiteVisits\Schemas\SiteVisitInfolist;
use App\Filament\Resources\SiteVisits\Tables\SiteVisitsTable;
use App\Models\SiteVisit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SiteVisitResource extends Resource
{
    protected static ?string $model = SiteVisit::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $recordTitleAttribute = 'SiteVisit';
    protected static string|UnitEnum|null $navigationGroup = 'Site Visit';
    protected static ?string $navigationLabel = 'Site Visit';

    public static function form(Schema $schema): Schema
    {
        return SiteVisitForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SiteVisitInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteVisitsTable::configure($table);
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
            'index' => ListSiteVisits::route('/'),
            'create' => CreateSiteVisit::route('/create'),
            'view' => ViewSiteVisit::route('/{record}'),
            'edit' => EditSiteVisit::route('/{record}/edit'),
        ];
    }
}
