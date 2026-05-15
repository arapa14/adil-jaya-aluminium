<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';

    protected $fillable = [
        'customer_name',
        'project_type',
        'rating',
        'message',
        'photo',
    ];
}
