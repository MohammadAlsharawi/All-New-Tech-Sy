<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferredTime extends Model
{
    protected $table = 'preferred_times';
    protected $fillable = [
        'time',
    ];
}
