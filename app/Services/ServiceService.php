<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceService
{
    public function index($propertyTypeId)
    {
        try {
            $query = Service::with('propertyType');

        if ($propertyTypeId) {
            $query->where('property_type_id', $propertyTypeId);
        }
        $locale = app()->getLocale();
        return $query->get()->map(function ($service) use ($locale) {
            return [
                'id'               => $service->id,
                'title'            => $service->getTranslation('title', app()->getLocale()),
                'description'      => $service->getTranslation('description', app()->getLocale()),
                'property_type'    => $service->propertyType?->name,
                'advantages'       => collect($service->getAttributeValue('advantages') ?? [])
                                        ->pluck($locale)
                                        ->values()
                                        ->toArray(),
                'created_at'       => $service->created_at,
                'updated_at'       => $service->updated_at,
            ];
        });
        } catch (\Exception $e) {
            throw new \Exception("Failed to retrieve services: " . $e->getMessage());
        }
    }
    private function mapAdvantagesByLocale($advantages)
    {
        if (empty($advantages) || !is_array($advantages)) {
            return [];
        }

        $locale = app()->getLocale();

        return collect($advantages)->map(function ($item) use ($locale) {
            return $item[$locale] ?? null;
        })->filter()->values()->toArray();
    }

}

