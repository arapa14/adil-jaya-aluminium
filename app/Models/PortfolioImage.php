<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    protected $table = 'portfolio_images';

    protected $fillable = [
        'portfolio_id',
        'image',
        'alt_text'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
