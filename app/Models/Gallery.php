<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = [
        'image',
        'type',
        'caption',
        'alt_text',
        'status,'
    ];
}
