<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get route key name for implicit binding by slug
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
