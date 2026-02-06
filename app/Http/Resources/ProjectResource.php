<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = app()->getLocale();

        return [
            'id' => $this->id,

            'title' => $this->getTranslation('title', $locale),

            'description' => $this->getTranslation('description', $locale),

            'service' => $this->service
                ? $this->service->getTranslation('title', $locale)
                : null,

            'property_type' => $this->propertyType
                ? $this->propertyType->getTranslation('name', $locale)
                : null,

            'challenges' => $this->mapTranslatableArray($this->challenges, $locale),

            'solutions' => $this->mapTranslatableArray($this->solutions, $locale),

            'images' => [
                'main' => $this->getMedia('main')->map->getUrl()->toArray(),
                'secondary' => $this->getMedia('secondary')->map->getUrl()->toArray(),
                'other' => $this->getMedia('other')->map->getUrl()->toArray(),
            ],

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Helper function to map translated JSON arrays
     */
    private function mapTranslatableArray($data, $locale)
    {
        if (empty($data) || !is_array($data)) {
            return [];
        }

        return collect($data)
            ->pluck($locale)
            ->filter()
            ->values()
            ->toArray();
    }
}
