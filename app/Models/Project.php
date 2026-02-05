<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia, HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'challenges',
        'solutions',
        'service_id',
        'property_type_id',
    ];
    public array $translatable = [
        'title',
        'description',
        'challenges',
        'solutions'
    ];
    protected $casts = [
        'challenges' => 'array',
        'solutions'  => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
