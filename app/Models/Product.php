<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'thumbnail',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'focus_keyword',
        'og_image',
        'alt_image',
        'status,'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
