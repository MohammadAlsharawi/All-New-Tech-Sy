<?php

namespace App\Filament\Resources\ContactMessages\Tables;

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

class ContactMessagesTable
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
                TextColumn::make('propertyType.name')
                    ->label('Property Type')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('service.title')
                    ->label('Service')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('message')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Filter::make('first_name')
                    ->form([
                        TextInput::make('first_name')
                            ->label('First Name'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when(
                            $data['first_name'],
                            fn ($q) => $q->where('first_name', 'like', '%' . $data['first_name'] . '%')
                        )
                    ),

                Filter::make('last_name')
                    ->form([
                        TextInput::make('last_name')
                            ->label('Last Name'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when(
                            $data['last_name'],
                            fn ($q) => $q->where('last_name', 'like', '%' . $data['last_name'] . '%')
                        )
                    ),

                Filter::make('email')
                    ->form([
                        TextInput::make('email')
                            ->label('Email'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when(
                            $data['email'],
                            fn ($q) => $q->where('email', 'like', '%' . $data['email'] . '%')
                        )
                    ),

                Filter::make('phone')
                    ->form([
                        TextInput::make('phone')
                            ->label('Phone'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when(
                            $data['phone'],
                            fn ($q) => $q->where('phone', 'like', '%' . $data['phone'] . '%')
                        )
                    ),

                SelectFilter::make('property_type_id')
                    ->label('Property Type')
                    ->relationship('propertyType', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('service_id')
                    ->label('Service')
                    ->relationship('service', 'title')
                    ->searchable()
                    ->preload(),

                Filter::make('message')
                    ->form([
                        TextInput::make('message')
                            ->label('Message Contains'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query->when(
                            $data['message'],
                            fn ($q) => $q->where('message', 'like', '%' . $data['message'] . '%')
                        )
                    ),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(fn ($query, $data) =>
                        $query
                            ->when($data['from'], fn ($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('created_at', '<=', $data['until']))
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
