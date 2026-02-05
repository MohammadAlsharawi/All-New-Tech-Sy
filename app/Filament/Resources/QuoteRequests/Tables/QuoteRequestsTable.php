<?php

namespace App\Filament\Resources\QuoteRequests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class QuoteRequestsTable
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
                TextColumn::make('requirements')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('propertyType.name')
                    ->label('Property Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('service.title')
                    ->label('Service')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('preferredContactMethod.name')
                    ->label('Preferred Contact Method')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('budgetRange.range')
                    ->label('Budget Range')
                    ->sortable()
                    ->searchable(),

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
                SelectFilter::make('property_type_id')
                    ->label('Property Type')
                    ->relationship('propertyType', 'name')
                    ->searchable()
                    ->preload(),

                // Filter by Service
                SelectFilter::make('service_id')
                    ->label('Service')
                    ->relationship('service', 'title')
                    ->searchable()
                    ->preload(),

                // Filter by Preferred Contact Method
                SelectFilter::make('preferred_contact_method_id')
                    ->label('Contact Method')
                    ->relationship('preferredContactMethod', 'name')
                    ->searchable()
                    ->preload(),

                // Filter by Budget Range
                SelectFilter::make('budget_range_id')
                    ->label('Budget Range')
                    ->relationship('budgetRange', 'range')
                    ->searchable()
                    ->preload(),

                // Confirmation Boolean Filter
                TernaryFilter::make('confirmation')
                    ->label('Confirmation')
                    ->placeholder('All')
                    ->trueLabel('Confirmed')
                    ->falseLabel('Not Confirmed'),

                // Search by Email
                Filter::make('email')
                    ->form([
                        TextInput::make('email')->label('Email contains'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when(
                            $data['email'],
                            fn ($q, $email) => $q->where('email', 'like', "%{$email}%")
                        )
                    ),

                // Search by Phone
                Filter::make('phone')
                    ->form([
                        TextInput::make('phone')->label('Phone contains'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when(
                            $data['phone'],
                            fn ($q, $phone) => $q->where('phone', 'like', "%{$phone}%")
                        )
                    ),

                // Created At Date Range Filter
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
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
