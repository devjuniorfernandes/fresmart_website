<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
