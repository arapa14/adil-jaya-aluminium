<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'focus_keyword',
        'og_image',
        'status',
        'created_by',
    ];
}
