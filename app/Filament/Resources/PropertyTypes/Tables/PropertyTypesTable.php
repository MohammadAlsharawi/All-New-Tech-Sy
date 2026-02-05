<?php

namespace App\Filament\Resources\PropertyTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PropertyTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('name')
                    ->form([
                        TextInput::make('name')
                            ->label('Name Contains'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when(
                            $data['name'],
                            fn ($query, $value) => $query->where('name', 'like', "%{$value}%")
                        );
                    }),

                // فلتر حسب تاريخ الإنشاء
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from')
                            ->label('Created From'),
                        DatePicker::make('until')
                            ->label('Created Until'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn ($query, $date) => $query->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['until'],
                                fn ($query, $date) => $query->whereDate('created_at', '<=', $date)
                            );
                    }),

                // فلتر سريع: يفرز الأحدث فقط
                TernaryFilter::make('recent')
                    ->label('Recently Added')
                    ->placeholder('All')
                    ->trueLabel('Last 7 Days')
                    ->falseLabel('Older')
                    ->queries(
                        true: fn ($query) => $query->where('created_at', '>=', now()->subDays(7)),
                        false: fn ($query) => $query->where('created_at', '<', now()->subDays(7)),
                    ),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
