<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $productImages = [
            'Kusen Aluminium Silver' => 3,
            'Kusen Aluminium Hitam' => 2,

            'Pintu Aluminium Minimalis' => 3,
            'Pintu Aluminium Geser' => 2,

            'Jendela Aluminium Modern' => 2,
            'Jendela Aluminium Putih' => 2,
        ];

        foreach ($productImages as $productName => $totalImages) {
            $product = Product::where('name', $productName)->first();

            if (!$product) {
                continue;
            }

            $slug = $product->slug;

            for ($i = 1; $i <= $totalImages; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'products/gallery/' . $slug . '/' . $slug . '-' . $i . '.jpg',
                    'alt_text' => $product->name . ' gallery image ' . $i,
                ]);
            }
        }
    }
}