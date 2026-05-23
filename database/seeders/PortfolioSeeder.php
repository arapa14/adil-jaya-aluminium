<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = [
            'Perkantoran' => [
                [
                    'title' => 'Pemasangan Aluminium Perkantoran Modern',
                    'location' => 'Jakarta Barat',
                ],
            ],
        ];

        foreach ($portfolios as $categoryName => $items) {
            $category = PortfolioCategory::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($items as $item) {

                $slug = Str::slug($item['title']);

                Portfolio::create([
                    'category_id' => $category->id,

                    'title' => $item['title'],
                    'slug' => $slug,

                    'description' => $item['title'] . ' menggunakan material aluminium dan kaca berkualitas tinggi.',

                    'location' => $item['location'],

                    'thumbnail' => 'portfolios/thumbnails/' . $slug . '-thumb.jpg',

                    'meta_title' => $item['title'],
                    'meta_description' => $item['title'] . ' portfolio project aluminium terbaik.',
                    'meta_keywords' => strtolower($item['title']) . ', aluminium, kaca',
                    'focus_keyword' => strtolower($item['title']),

                    'og_image' => 'portfolios/thumbnails/' . $slug . '-thumb.jpg',

                    'alt_image' => $item['title'],
                ]);
            }
        }
    }
}
