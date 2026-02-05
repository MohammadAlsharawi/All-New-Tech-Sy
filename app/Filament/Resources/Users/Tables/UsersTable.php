<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('gender'),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
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
                // Filter by Name
                Filter::make('name')
                    ->form([
                        TextInput::make('name')
                            ->label('Name'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['name'],
                            fn ($q, $name) => $q->where('name', 'like', "%{$name}%")
                        );
                    }),

                // Filter by Email
                Filter::make('email')
                    ->form([
                        TextInput::make('email')
                            ->label('Email'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['email'],
                            fn ($q, $email) => $q->where('email', 'like', "%{$email}%")
                        );
                    }),

                // Filter by Email Verified Date
                Filter::make('email_verified_at')
                    ->form([
                        DatePicker::make('from')->label('Verified From'),
                        DatePicker::make('until')->label('Verified Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn ($q, $date) => $q->whereDate('email_verified_at', '>=', $date)
                            )
                            ->when(
                                $data['until'],
                                fn ($q, $date) => $q->whereDate('email_verified_at', '<=', $date)
                            );
                    }),

                // Filter by Created At Date
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from')->label('Created From'),
                        DatePicker::make('until')->label('Created Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn ($q, $date) => $q->whereDate('created_at', '>=', $date)
                            )
                            ->when(
                                $data['until'],
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
