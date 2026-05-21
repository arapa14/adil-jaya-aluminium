<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'image',
        'caption',
        'alt_text',
        'status',
        'created_by',
    ];
}
