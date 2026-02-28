<?php

namespace App\Services;

use App\Models\Location;

class LocationService
{
    public function index()
    {
        try {
            return Location::all()->map(function ($update) {
                return [
                    'id'          => $update->id,
                    'name'       => $update->name,
                    'address'     => $update->address,
                    'latitude' => $update->latitude,
                    'longitude' => $update->longitude,
                    'is_main'=> $update->is_main,
                    'created_at'  => $update->created_at,
                    'updated_at'  => $update->updated_at,
                ];
            });
        } catch (\Exception $e) {
            throw new \Exception("Failed to retrieve locations: " . $e->getMessage());
        }
    }
}
