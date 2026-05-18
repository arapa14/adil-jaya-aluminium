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
                ['name' => 'Kusen Aluminium Silver'],
                ['name' => 'Kusen Aluminium Hitam'],
            ],

            'Pintu Aluminium' => [
                ['name' => 'Pintu Aluminium Minimalis'],
                ['name' => 'Pintu Aluminium Geser'],
            ],

            'Jendela Aluminium' => [
                ['name' => 'Jendela Aluminium Modern'],
                ['name' => 'Jendela Aluminium Putih'],
            ],
        ];

        foreach ($products as $categoryName => $items) {
            $category = ProductCategory::where('name', $categoryName)->first();

            if (!$category) {
                continue;
            }

            foreach ($items as $item) {
                $slug = Str::slug($item['name']);

                Product::create([
                    'category_id' => $category->id,

                    'name' => $item['name'],
                    'slug' => $slug,

                    'description' => $item['name'] . ' berkualitas tinggi untuk kebutuhan bangunan modern.',

                    'thumbnail' => 'products/thumbnails/' . $slug . '-thumb.jpg',

                    'meta_title' => $item['name'],
                    'meta_description' => $item['name'] . ' berkualitas terbaik.',
                    'meta_keywords' => strtolower($item['name']) . ', aluminium',
                    'focus_keyword' => strtolower($item['name']),

                    'og_image' => 'products/thumbnails/' . $slug . '-thumb.jpg',

                    'alt_image' => $item['name'],

                    'created_by' => 1,
                ]);
            }
        }
    }
}
