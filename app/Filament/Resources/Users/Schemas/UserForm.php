<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;


class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('last_name')
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                Select::make('gender')
                    ->options(['male' => 'Male', 'female' => 'Female'])
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Hidden::make('email_verified_at')
                    ->default(fn (Page $livewire) =>
                        $livewire instanceof EditRecord ? now() : null
                    ),


                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->minLength(6)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (Page $livewire) => $livewire instanceof CreateRecord)
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state)),

                            ]);
    }
}
