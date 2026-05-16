<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            'Kusen Aluminium' => [
                [
                    'name' => 'Kusen Aluminium Silver',
                    'thumbnail' => 'products/thumbnails/kusen-silver-thumb.jpg',
                ],
                [
                    'name' => 'Kusen Aluminium Hitam',
                    'thumbnail' => 'products/thumbnails/kusen-hitam-thumb.jpg',
                ],
            ],

            'Pintu Aluminium' => [
                [
                    'name' => 'Pintu Aluminium Minimalis',
                    'thumbnail' => 'products/thumbnails/pintu-minimalis-thumb.jpg',
                ],
                [
                    'name' => 'Pintu Aluminium Geser',
                    'thumbnail' => 'products/thumbnails/pintu-geser-thumb.jpg',
                ],
            ],

            'Jendela Aluminium' => [
                [
                    'name' => 'Jendela Aluminium Modern',
                    'thumbnail' => 'products/thumbnails/jendela-modern-thumb.jpg',
                ],
                [
                    'name' => 'Jendela Aluminium Putih',
                    'thumbnail' => 'products/thumbnails/jendela-putih-thumb.jpg',
                ],
            ],
        ];

        foreach ($products as $categoryName => $items) {

            $category = ProductCategory::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($items as $item) {

                Product::create([
                    'category_id' => $category->id,

                    'name' => $item['name'],
                    'slug' => Str::slug($item['name']),

                    'description' => $item['name'] . ' berkualitas tinggi untuk kebutuhan bangunan modern.',

                    'thumbnail' => $item['thumbnail'],

                    'meta_title' => $item['name'],
                    'meta_description' => $item['name'] . ' berkualitas terbaik.',
                    'meta_keywords' => strtolower($item['name']) . ', aluminium',
                    'focus_keyword' => strtolower($item['name']),

                    'og_image' => $item['thumbnail'],

                    'alt_image' => $item['name'],

                    'created_by' => 1 // Assuming you want to set the created_by field to a specific user ID
                ]);
            }
        }
    }
}
