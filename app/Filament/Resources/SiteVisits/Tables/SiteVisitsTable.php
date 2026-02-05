<?php

namespace App\Filament\Resources\SiteVisits\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SiteVisitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('post_code')
                    ->searchable(),
                TextColumn::make('address')
                    ->searchable(),
                TextColumn::make('propertyType.name')
                    ->label('Property Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('preferredTime.time')
                    ->label('Preferred Time')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('service.title')
                    ->label('Service')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('preferred_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('notes')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('confirmation')
                    ->boolean(),
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
                // Filter by Property Type
                Filter::make('property_service_filter')
                ->form([

                    Select::make('property_type_id')
                        ->label('Property Type')
                        ->options(\App\Models\PropertyType::pluck('name', 'id'))
                        ->searchable()
                        ->reactive(),

                    Select::make('service_id')
                        ->label('Service')
                        ->options(function (callable $get) {

                            $propertyTypeId = $get('property_type_id');

                            if (! $propertyTypeId) {
                                return [];
                            }

                            return \App\Models\Service::where('property_type_id', $propertyTypeId)
                                ->pluck('title', 'id');
                        })
                        ->searchable(),

                ])
                ->query(function (Builder $query, array $data) {

                    return $query
                        ->when(
                            $data['property_type_id'],
                            fn ($q, $id) => $q->where('property_type_id', $id)
                        )
                        ->when(
                            $data['service_id'],
                            fn ($q, $id) => $q->where('service_id', $id)
                        );
                }),


                // Filter by Preferred Time
                SelectFilter::make('preferred_time_id')
                    ->label('Preferred Time')
                    ->relationship('preferredTime', 'time')
                    ->searchable()
                    ->preload(),

                // Filter by Confirmation (Yes / No)
                TernaryFilter::make('confirmation')
                    ->label('Confirmation')
                    ->trueLabel('Confirmed')
                    ->falseLabel('Not Confirmed')
                    ->placeholder('All'),

                // Filter by Preferred Date Range
                Filter::make('preferred_date')
                    ->form([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn ($query, $date) => $query->whereDate('preferred_date', '>=', $date)
                            )
                            ->when(
                                $data['until'],
                                fn ($query, $date) => $query->whereDate('preferred_date', '<=', $date)
                            );
                    }),

                // Filter by Created At
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from')->label('From'),
                        DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function ($query, array $data) {
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
