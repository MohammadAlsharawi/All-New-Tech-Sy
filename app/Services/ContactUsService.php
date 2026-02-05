<?php

namespace App\Services;

use App\Models\ContactMessage;
use App\Models\PropertyType;
use App\Models\Service;

class ContactUsService
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
            ];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function store($data){
        try{
            $contactUs = ContactMessage::create($data);
            return $contactUs;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
