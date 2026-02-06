<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')
                    ->square()
                    ->size(300)
                    ->disk('public'),
                TextEntry::make('title')
                    ->label(__('Title'))
                    ->getStateUsing(fn ($record) =>
                        $record->getTranslation('title', app()->getLocale())
                    ),

                TextEntry::make('description')
                    ->label(__('Description'))
                    ->getStateUsing(fn ($record) =>
                        $record->getTranslation('description', app()->getLocale())
                    ),

                TextEntry::make('propertyType.name')
                    ->label('Property Type'),

                TextEntry::make('advantages')
                    ->label('Advantages')
                    ->html()
                    ->formatStateUsing(function ($state) {
                        if (empty($state)) {
                            return '';
                        }

                        $locale = app()->getLocale();

                        // إذا كان عنصر واحد فقط، حوله لمصفوفة
                        $items = is_array($state) && isset($state['en']) ? [$state] : $state;

                        $lines = collect($items)
                            ->map(fn($item) => $item[$locale] ?? null)
                            ->filter()
                            ->map(function ($text) {
                                // إزالة أي فواصل وtrim للفراغات
                                $text = trim(str_replace(',', '', $text));

                                // إضافة نقطة كبيرة قبل النص
                                return '
                                <div style="
                                    background-color: #374151; /* رمادي غامق */
                                    color: #f9fafb; /* نص أبيض */
                                    padding: 0.75rem 1rem;
                                    border-radius: 0.5rem;
                                    margin-bottom: 0.5rem;
                                    display: block;
                                    width: 100%;
                                    box-sizing: border-box;
                                    word-wrap: break-word;
                                    font-size: 1rem;
                                ">
                                    • ' . e($text) . '
                                </div>';
                            })
                            ->implode('');

                        return $lines;
                    }),

                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
