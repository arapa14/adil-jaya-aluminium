<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolios';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'location',
        'thumbnail',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'focus_keyword',
        'og_image',
        'alt_image',
    ];

    public function category()
    {
        return $this->belongsTo(PortfolioCategory::class);
    }

    public function images()
    {
        return $this->hasMany(PortfolioImage::class);
    }
}
