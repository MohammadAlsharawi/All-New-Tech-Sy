<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->square()
                    ->circular()
                    ->size(80)
                    ->disk('public'),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('description')
                ->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('propertyType.name')
                    ->label('Property Type')
                    ->sortable()
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
                // 1- فلتر البحث داخل العنوان
                Filter::make('title')
                    ->form([
                        TextInput::make('title')
                            ->label('Title Contains'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when(
                            $data['title'],
                            fn ($query, $value) => $query->where('title', 'like', "%{$value}%")
                        );
                    }),

                // 2- فلتر اختيار Property Type بالاسم
                SelectFilter::make('property_type_id')
                    ->label('Property Type')
                    ->relationship('propertyType', 'name')
                    ->searchable()
                    ->preload(),

                // 3- فلتر حسب تاريخ الإنشاء (من – إلى)
                Filter::make('created_at')
                    ->label('Created Date')
                    ->form([
                        DatePicker::make('from')
                            ->label('From'),
                        DatePicker::make('until')
                            ->label('Until'),
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

                // 4- فلتر سريع: العناصر الحديثة
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
