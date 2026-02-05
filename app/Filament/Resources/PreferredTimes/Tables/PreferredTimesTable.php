<?php

namespace App\Filament\Resources\PreferredTimes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PreferredTimesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('time')
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
                  // فلتر البحث داخل الوقت
                Filter::make('time')
                    ->form([
                        TextInput::make('time')
                            ->label('Time Contains'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when(
                            $data['time'],
                            fn ($query, $value) => $query->where('time', 'like', "%{$value}%")
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

                // فلتر جاهز للأوقات الصباحية والمسائية (اختياري لكنه مفيد)
                SelectFilter::make('period')
                    ->label('Time Period')
                    ->options([
                        'am' => 'AM Times',
                        'pm' => 'PM Times',
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when($data['value'] === 'am', function ($query) {
                            $query->where('time', 'like', '%AM%');
                        })->when($data['value'] === 'pm', function ($query) {
                            $query->where('time', 'like', '%PM%');
                        });
                    }),
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
