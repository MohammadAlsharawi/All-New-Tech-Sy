<?php

namespace App\Filament\Resources\LatestNews;

use App\Filament\Resources\LatestNews\Pages\CreateLatestNews;
use App\Filament\Resources\LatestNews\Pages\EditLatestNews;
use App\Filament\Resources\LatestNews\Pages\ListLatestNews;
use App\Filament\Resources\LatestNews\Pages\ViewLatestNews;
use App\Filament\Resources\LatestNews\Schemas\LatestNewsForm;
use App\Filament\Resources\LatestNews\Schemas\LatestNewsInfolist;
use App\Filament\Resources\LatestNews\Tables\LatestNewsTable;
use App\Models\LatestNews;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LatestNewsResource extends Resource
{
    protected static ?string $model = LatestNews::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $recordTitleAttribute = 'LatestNews';
    protected static string|UnitEnum|null $navigationGroup = 'Latest News';
    protected static ?string $navigationLabel = 'Latest News';

    public static function form(Schema $schema): Schema
    {
        return LatestNewsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LatestNewsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LatestNewsTable::configure($table);
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
            'index' => ListLatestNews::route('/'),
            'create' => CreateLatestNews::route('/create'),
            'view' => ViewLatestNews::route('/{record}'),
            'edit' => EditLatestNews::route('/{record}/edit'),
        ];
    }
}
