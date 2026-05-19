<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'company_name',
        'company_desc',
        'address',
        'whatsapp',
        'email',
        'maps_embed',
        'facebook',
        'instagram',
        'visson',
        'mission',
        'logo',
        'favicon',
        'hero_image'
    ];
}
