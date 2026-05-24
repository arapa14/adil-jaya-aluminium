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
            'Kusen UPVC Merk Conch' => 1,
            'Pintu Lipat dan Jalusi 4 Daun' => 1,
            'Pintu Lipat Sudut 5 Daun' => 1,
            'Pintu Garasi Dorong' => 1,
            'Jendela Swing Lengkung' => 1,
            'Jendela Sliding 3 Daun' => 1,
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