<?php

namespace App\Filament\Resources\PreferredTimes;

use App\Filament\Resources\PreferredTimes\Pages\CreatePreferredTime;
use App\Filament\Resources\PreferredTimes\Pages\EditPreferredTime;
use App\Filament\Resources\PreferredTimes\Pages\ListPreferredTimes;
use App\Filament\Resources\PreferredTimes\Pages\ViewPreferredTime;
use App\Filament\Resources\PreferredTimes\Schemas\PreferredTimeForm;
use App\Filament\Resources\PreferredTimes\Schemas\PreferredTimeInfolist;
use App\Filament\Resources\PreferredTimes\Tables\PreferredTimesTable;
use App\Models\PreferredTime;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PreferredTimeResource extends Resource
{
    protected static ?string $model = PreferredTime::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    protected static ?string $recordTitleAttribute = 'PreferredTime';
    protected static string|UnitEnum|null $navigationGroup = 'Site Visit';
    protected static ?string $navigationLabel = 'Preferred Time';

    public static function form(Schema $schema): Schema
    {
        return PreferredTimeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PreferredTimeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PreferredTimesTable::configure($table);
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
            'index' => ListPreferredTimes::route('/'),
            'create' => CreatePreferredTime::route('/create'),
            'view' => ViewPreferredTime::route('/{record}'),
            'edit' => EditPreferredTime::route('/{record}/edit'),
        ];
    }
}
