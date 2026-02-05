<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'property_type_id',
        'service_id',
        'message',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
