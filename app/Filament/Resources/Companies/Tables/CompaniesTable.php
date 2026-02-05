<?php

namespace App\Filament\Resources\Companies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;


class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                ImageColumn::make('logo')
                    ->square()
                    ->circular()
                    ->size(80)
                    ->disk('public'),
                TextColumn::make('priority')
                    ->numeric()
                    ->sortable(),
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
                            ->label('Search Name'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query->when(
                            $data['name'],
                            fn (Builder $query, $value) => $query->where('name', 'like', "%{$value}%")
                        );
                    }),

                // Filter by priority range
                Filter::make('priority')
                    ->form([
                        TextInput::make('min')
                            ->numeric()
                            ->label('Min Priority'),
                        TextInput::make('max')
                            ->numeric()
                            ->label('Max Priority'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['min'],
                                fn ($query, $value) => $query->where('priority', '>=', $value)
                            )
                            ->when(
                                $data['max'],
                                fn ($query, $value) => $query->where('priority', '<=', $value)
                            );
                    }),

                // Filter by creation date
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

                // Filter companies with or without logo
                TernaryFilter::make('has_logo')
                    ->label('Logo Status')
                    ->placeholder('All')
                    ->trueLabel('With Logo')
                    ->falseLabel('Without Logo')
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('logo'),
                        false: fn ($query) => $query->whereNull('logo'),
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
