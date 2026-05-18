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
            'Rumah Tinggal' => [
                [
                    'title' => 'Pemasangan Kusen Aluminium Rumah Minimalis',
                    'location' => 'Jakarta Selatan',
                    'thumbnail' => 'portfolios/thumbnails/rumah-minimalis-thumb.jpg',
                ],
                [
                    'title' => 'Jendela Aluminium Modern Residence',
                    'location' => 'Bekasi',
                    'thumbnail' => 'portfolios/thumbnails/jendela-modern-thumb.jpg',
                ],
            ],
            'Perkantoran' => [
                [
                    'title' => 'Facade Kaca Gedung Office Tower',
                    'location' => 'Jakarta Pusat',
                    'thumbnail' => 'portfolios/thumbnails/office-tower-thumb.jpg',
                ],
                [
                    'title' => 'Partisi Aluminium Kantor Modern',
                    'location' => 'Tangerang',
                    'thumbnail' => 'portfolios/thumbnails/partisi-kantor-thumb.jpg',
                ],
            ],
            'Ruko & Komersial' => [
                [
                    'title' => 'Pintu Aluminium Ruko Premium',
                    'location' => 'Depok',
                    'thumbnail' => 'portfolios/thumbnails/ruko-premium-thumb.jpg',
                ],
                [
                    'title' => 'Kaca Tempered Cafe Minimalis',
                    'location' => 'Bogor',
                    'thumbnail' => 'portfolios/thumbnails/cafe-minimalis-thumb.jpg',
                ],
            ],
        ];

        foreach ($portfolios as $categoryName => $items) {
            $category = PortfolioCategory::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($items as $item) {

                Portfolio::create([

                    'category_id' => $category->id,

                    'title' => $item['title'],
                    'slug' => Str::slug($item['title']),

                    'description' => $item['title'] . ' menggunakan material aluminium dan kaca berkualitas tinggi.',

                    'location' => $item['location'],

                    'thumbnail' => $item['thumbnail'],

                    'meta_title' => $item['title'],
                    'meta_description' => $item['title'] . ' portfolio project aluminium terbaik.',
                    'meta_keywords' => strtolower($item['title']) . ', aluminium, kaca',
                    'focus_keyword' => strtolower($item['title']),

                    'og_image' => $item['thumbnail'],

                    'alt_image' => $item['title'],
                ]);
            }
        }
    }
}
