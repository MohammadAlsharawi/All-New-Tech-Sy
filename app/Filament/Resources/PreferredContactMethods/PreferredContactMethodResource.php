<?php

namespace App\Filament\Resources\PreferredContactMethods;

use App\Filament\Resources\PreferredContactMethods\Pages\CreatePreferredContactMethod;
use App\Filament\Resources\PreferredContactMethods\Pages\EditPreferredContactMethod;
use App\Filament\Resources\PreferredContactMethods\Pages\ListPreferredContactMethods;
use App\Filament\Resources\PreferredContactMethods\Pages\ViewPreferredContactMethod;
use App\Filament\Resources\PreferredContactMethods\Schemas\PreferredContactMethodForm;
use App\Filament\Resources\PreferredContactMethods\Schemas\PreferredContactMethodInfolist;
use App\Filament\Resources\PreferredContactMethods\Tables\PreferredContactMethodsTable;
use App\Models\PreferredContactMethod;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PreferredContactMethodResource extends Resource
{
    protected static ?string $model = PreferredContactMethod::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-phone';

    protected static ?string $recordTitleAttribute = 'PreferredContactMethod';
    protected static string|UnitEnum|null $navigationGroup = 'Quote Request';
    protected static ?string $navigationLabel = 'Preferred Contact Method';

    public static function form(Schema $schema): Schema
    {
        return PreferredContactMethodForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PreferredContactMethodInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PreferredContactMethodsTable::configure($table);
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
            'index' => ListPreferredContactMethods::route('/'),
            'create' => CreatePreferredContactMethod::route('/create'),
            'view' => ViewPreferredContactMethod::route('/{record}'),
            'edit' => EditPreferredContactMethod::route('/{record}/edit'),
        ];
    }
}
