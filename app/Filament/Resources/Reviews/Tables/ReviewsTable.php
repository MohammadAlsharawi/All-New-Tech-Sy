<?php

namespace App\Filament\Resources\Reviews\Tables;

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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;


class ReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user_image')
                    ->square()
                    ->circular()
                    ->size(80)
                    ->disk('public'),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        $stars = '';
                        for ($i = 1; $i <= 5; $i++) {
                            $stars .= $i <= $state ? '⭐' : '☆';
                        }
                        return $stars;
                    })
                    ->html(),

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
                Filter::make('rating')
                    ->form([
                        TextInput::make('min')
                            ->numeric()
                            ->label('Min Rating'),
                        TextInput::make('max')
                            ->numeric()
                            ->label('Max Rating'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['min'],
                                fn ($query, $value) => $query->where('rating', '>=', $value)
                            )
                            ->when(
                                $data['max'],
                                fn ($query, $value) => $query->where('rating', '<=', $value)
                            );
                    }),

                // Quick filter for high ratings
                SelectFilter::make('rating_level')
                    ->label('Rating Level')
                    ->options([
                        '5' => '5 Stars',
                        '4' => '4 Stars',
                        '3' => '3 Stars',
                        '2' => '2 Stars',
                        '1' => '1 Star',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['value']) {
                            $query->where('rating', $data['value']);
                        }
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

                // Filter reviews with or without user image
                TernaryFilter::make('has_image')
                    ->label('Image Status')
                    ->placeholder('All')
                    ->trueLabel('With Image')
                    ->falseLabel('Without Image')
                    ->queries(
                        true: fn ($query) => $query->whereNotNull('user_image'),
                        false: fn ($query) => $query->whereNull('user_image'),
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
