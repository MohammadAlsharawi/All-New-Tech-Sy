<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,

            'service' => $this->service?->title,
            'property_type' => $this->propertyType?->name,

            'challenges' => $this->challenges,
            'solutions' =>  $this->solutions,

            'images' => [
                'main' => $this->getMedia('main')->map->getUrl(),
                'secondary' => $this->getMedia('secondary')->map->getUrl(),
                'other' => $this->getMedia('other')->map->getUrl(),
            ],

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
