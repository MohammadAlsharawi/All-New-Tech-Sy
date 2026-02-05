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

        return $query->get()->map(function ($service) {
            return [
                'id'               => $service->id,
                'title'            => $service->title,
                'description'      => $service->description,
                'property_type'    => $service->propertyType?->name,
                'advantages'       => $service->advantages,
                'created_at'       => $service->created_at,
                'updated_at'       => $service->updated_at,
            ];
        });
        } catch (\Exception $e) {
            throw new \Exception("Failed to retrieve services: " . $e->getMessage());
        }
    }
}

