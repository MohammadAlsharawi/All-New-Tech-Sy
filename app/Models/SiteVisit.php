<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVisit extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'post_code',
        'property_type_id',
        'address',
        'service_id',
        'preferred_date',
        'preferred_time_id',
        'notes',
        'confirmation',
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'confirmation'   => 'boolean',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function preferredTime()
    {
        return $this->belongsTo(PreferredTime::class);
    }
}
