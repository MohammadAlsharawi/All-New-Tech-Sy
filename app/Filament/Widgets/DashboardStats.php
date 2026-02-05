<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Project;
use App\Models\Service;
use App\Models\Company;
use App\Models\QuoteRequest;
use App\Models\SiteVisit;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            // ===========================
            // Users Card
            // ===========================
            Stat::make('Total Users', User::count())
                ->description('Active platform users')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([7, 10, 14, 18, 20, 25, User::count()])
                ->color('primary'),

            // ===========================
            // Companies
            // ===========================
            Stat::make('Companies', Company::count())
                ->description('Registered companies')
                ->descriptionIcon('heroicon-m-building-office')
                ->chart([2, 4, 5, 7, 8, 10, Company::count()])
                ->color('success'),

            // ===========================
            // Quote Requests
            // ===========================
            Stat::make('Quote Requests', QuoteRequest::count())
                ->description('Total client requests')
                ->descriptionIcon('heroicon-m-document-text')
                ->chart([5, 9, 12, 15, 18, 20, QuoteRequest::count()])
                ->color('warning'),

            // ===========================
            // Site Visits
            // ===========================
            Stat::make('Site Visits', SiteVisit::count())
                ->description('Inspection bookings')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->chart([3, 5, 8, 10, 12, 15, SiteVisit::count()])
                ->color('info'),

            // ===========================
            // Home Projects
            // ===========================
            Stat::make(
                'Home Projects',
                Project::where('property_type_id', 1)->count()
            )
                ->description('Residential projects')
                ->descriptionIcon('heroicon-m-home')
                ->chart([1, 2, 3, 5, 8, 10, Project::where('property_type_id', 1)->count()])
                ->color('success'),

            // ===========================
            // Commercial Projects
            // ===========================
            Stat::make(
                'Commercial Projects',
                Project::where('property_type_id', 2)->count()
            )
                ->description('Business projects')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->chart([1, 3, 4, 6, 7, 9, Project::where('property_type_id', 2)->count()])
                ->color('danger'),

            // ===========================
            // Home Services
            // ===========================
            Stat::make(
                'Home Services',
                Service::where('property_type_id', 1)->count()
            )
                ->description('Residential services')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->chart([2, 3, 4, 6, 8, 9, Service::where('property_type_id', 1)->count()])
                ->color('success'),

            // ===========================
            // Commercial Services
            // ===========================
            Stat::make(
                'Commercial Services',
                Service::where('property_type_id', 2)->count()
            )
                ->description('Commercial services')
                ->descriptionIcon('heroicon-m-cog-8-tooth')
                ->chart([1, 2, 3, 4, 5, 6, Service::where('property_type_id', 2)->count()])
                ->color('danger'),
        ];
    }
}
