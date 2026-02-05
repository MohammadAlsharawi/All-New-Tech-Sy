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
                                        TextEntry::make('title')->label('Project Title'),
                                        TextEntry::make('service.title')->label('Service'),
                                        TextEntry::make('propertyType.name')->label('Property Type'),
                                        TextEntry::make('created_at')->dateTime(),
                                        TextEntry::make('updated_at')->dateTime(),
                                    ]),

                                TextEntry::make('description')
                                    ->columnSpanFull(),

                                RepeatableEntry::make('challenges')
                                    ->label('Challenges')
                                    ->schema([
                                        TextEntry::make('item')->label('')
                                            ->formatStateUsing(fn($state) => "• " . $state),
                                    ])
                                    ->columnSpanFull(),

                                RepeatableEntry::make('solutions')
                                    ->label('Solutions')
                                    ->schema([
                                        TextEntry::make('item')->label('')
                                            ->formatStateUsing(fn($state) => "• " . $state),
                                    ])
                                    ->columnSpanFull(),

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
