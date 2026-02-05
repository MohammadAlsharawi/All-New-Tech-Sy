<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasTranslations;
    protected $fillable = [
        'image',
        'title',
        'description',
        'property_type_id',
        'advantages'
    ];

    public array $translatable = [
        'title',
        'description',
        'advantages',
    ];
    protected $casts = [
        'advantages' => 'array',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
