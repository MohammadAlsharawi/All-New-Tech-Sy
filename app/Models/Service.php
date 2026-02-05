<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'image',
        'title',
        'description',
        'property_type_id',
        'advantages'
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
