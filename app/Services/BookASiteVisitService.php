<?php

namespace App\Services;

use App\Models\PreferredTime;
use App\Models\PropertyType;
use App\Models\Service;
use App\Models\SiteVisit;
use Illuminate\Support\Facades\Storage;

class BookASiteVisitService
{
    public function getFormData()
    {
        try {
            return [
                'services' => Service::all()->map(fn ($item) => [
                    'id'   => $item->id,
                    'name' => $item->title,
                ]),
                'propertyType' => PropertyType::all()->map(fn ($item) => [
                    'id'   => $item->id,
                    'name' => $item->name,
                ]),
                'preferredContactMethod' => PreferredTime::all()->map(fn ($item) => [
                    'id'   => $item->id,
                    'name' => $item->name,
                ]),
            ];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function store($data){
        try{
            $SiteVisit = SiteVisit::create($data);
            $response = $SiteVisit
                ->load(['preferredTime','service','propertyType'])
                ->toArray();

            if ($SiteVisit->service) {
                $response['service']['image'] = Storage::disk('public')->url($SiteVisit->service->image);
            }
            return $response;
        }catch(\Exception $e){
            throw new \Exception("Failed to create a request for a quote : " . $e->getMessage());
        }
    }
}
