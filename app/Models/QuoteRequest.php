<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteRequest extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'post_code',
        'property_type_id',
        'service_id',
        'requirements',
        'preferred_contact_method_id',
        'budget_range_id',
        'file',
        'confirmation',
    ];

    protected $casts = [
        'confirmation' => 'boolean',
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function preferredContactMethod()
    {
        return $this->belongsTo(PreferredContactMethod::class);
    }

    public function budgetRange()
    {
        return $this->belongsTo(BudgetRange::class);
    }
}
