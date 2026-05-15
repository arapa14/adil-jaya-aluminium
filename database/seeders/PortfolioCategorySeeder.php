<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\PortfolioCategory;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Rumah Tinggal',
            'Perkantoran',
            'Ruko & Komersial',
        ];

        foreach ($categories as $category) {

            PortfolioCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
