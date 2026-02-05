<?php

namespace App\Filament\Resources\Projects\Tables;

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

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('service.title')
                    ->label('Service')
                    ->sortable()
                    ->searchable(),

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
                    SelectFilter::make('service_id')
                        ->label('Service')
                        ->relationship('service', 'title')
                        ->searchable()
                        ->preload(),

                    SelectFilter::make('property_type_id')
                        ->label('Property Type')
                        ->relationship('propertyType', 'name')
                        ->searchable()
                        ->preload(),

                        Filter::make('description')
                    ->form([
                        TextInput::make('description')
                            ->label('Search in Description'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['description'],
                            fn ($q, $value) => $q->where('description', 'like', "%{$value}%")
                        );
                    }),


                    Filter::make('title')
                        ->form([
                            TextInput::make('title')
                                ->label('Search by Title'),
                        ])
                        ->query(function ($query, array $data) {
                            return $query->when(
                                $data['title'],
                                fn ($q, $value) => $q->where('title', 'like', "%{$value}%")
                            );
                        }),
                        Filter::make('description')
                    ->form([
                        TextInput::make('description')
                            ->label('Search in Description'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['description'],
                            fn ($q, $value) => $q->where('description', 'like', "%{$value}%")
                        );
                    }),


                    Filter::make('created_at')
                        ->form([
                            DatePicker::make('from')->label('Created From'),
                            DatePicker::make('to')->label('Created To'),
                        ])
                        ->query(function ($query, array $data) {
                            return $query
                                ->when(
                                    $data['from'],
                                    fn ($q, $date) => $q->whereDate('created_at', '>=', $date)
                                )
                                ->when(
                                    $data['to'],
                                    fn ($q, $date) => $q->whereDate('created_at', '<=', $date)
                                );
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
