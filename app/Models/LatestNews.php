<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LatestNews extends Model
{
    protected $table = 'latest_news';

    protected $fillable = [
        'image',
        'title',
        'content',
    ];
}
