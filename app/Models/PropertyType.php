<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PropertyType extends Model
{
    use HasTranslations;
    protected $fillable = [
        'name',
    ];
    public array $translatable = ['name'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
