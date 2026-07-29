<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link',
        'is_active',
    ];

    /**
     * Accessor for backward compatibility with image_path
     */
    public function getImagePathAttribute()
    {
        return $this->image;
    }

    /**
     * Accessor for backward compatibility with link_url
     */
    public function getLinkUrlAttribute()
    {
        return $this->link;
    }
}
