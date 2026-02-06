<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class ProjectInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Tabs::make('ProjectTabs')
                    ->tabs([

                        // ==========================
                        // TAB 1 - INFORMATION
                        // ==========================
                        Tabs\Tab::make('Information')
                            ->schema([

                                Grid::make(2)
                                    ->schema([
                                        TextEntry::make('title')
                                            ->label(__('Title'))
                                            ->getStateUsing(fn ($record) =>
                                                $record->getTranslation('title', app()->getLocale())
                                            ),
                                        TextEntry::make('service.title')->label('Service'),
                                        TextEntry::make('propertyType.name')->label('Property Type'),
                                        TextEntry::make('created_at')->dateTime(),
                                        TextEntry::make('updated_at')->dateTime(),
                                    ]),
                                TextEntry::make('description')
                                    ->label(__('Description'))
                                    ->getStateUsing(fn ($record) =>
                                        $record->getTranslation('description', app()->getLocale())
                                    ),


                                TextEntry::make('challenges')
                                    ->label('Challenges')
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
                                    TextEntry::make('solutions')
                                    ->label('Solutions')
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

                            ]),

                        // ==========================
                        // TAB 2 - IMAGES
                        // ==========================
                        Tabs\Tab::make('Images')
                            ->schema([

                                Grid::make(3) // 3 أعمدة للشاشة
                                    ->schema([

                                        SpatieMediaLibraryImageEntry::make('main')
                                            ->label('Main Image')
                                            ->collection('main'),

                                        SpatieMediaLibraryImageEntry::make('secondary')
                                            ->label('Secondary Images')
                                            ->collection('secondary'),

                                        SpatieMediaLibraryImageEntry::make('other')
                                            ->label('Other Images')
                                            ->collection('other'),

                                    ])
                                    ->columns(3)
                                    ->gap(4),
                            ]),

                    ])
                    ->columnSpanFull(), // يملأ عرض الشاشة
            ]);
    }
}
