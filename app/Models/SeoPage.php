<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
    protected $table = 'seo_pages';

    protected $fillable = [
        'page_name',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'focus_keyword',
        'og_title',
        'og_description',
        'og_image',
        'canonical_url',
        'robots_index',
        'robots_follow',
        'schema_markup',
    ];
}
