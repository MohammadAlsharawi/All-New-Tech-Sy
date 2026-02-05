<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class LatestNews extends Model
{
    use HasTranslations;
    protected $table = 'latest_news';

    protected $fillable = [
        'image',
        'title',
        'content',
    ];
    public array $translatable = [
        'title',
        'content',
    ];
}
