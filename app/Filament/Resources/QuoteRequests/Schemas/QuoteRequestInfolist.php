<?php

namespace App\Filament\Resources\QuoteRequests\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Support\Enums\IconSize;

class QuoteRequestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('first_name'),
                TextEntry::make('last_name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('phone'),
                TextEntry::make('post_code'),
                TextEntry::make('requirements'),
                TextEntry::make('propertyType.name')
                    ->label('Property Type'),

                TextEntry::make('service.title')
                    ->label('Service'),

                TextEntry::make('preferredContactMethod.name')
                    ->label('Preferred Contact Method'),

                TextEntry::make('budgetRange.range')
                    ->label('Budget Range'),

                IconEntry::make('file')
                    ->label('File')
                    ->url(fn ($record) => $record->file
                        ? asset('storage/' . $record->file)
                        : null
                    )
                    ->icon('heroicon-o-document-text')
                    ->openUrlInNewTab()
                    ->color('success')
                    ->size(IconSize::ExtraLarge),
                IconEntry::make('confirmation')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
