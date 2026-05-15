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

            'Kusen Aluminium Silver' => [
                'products/gallery/kusen-silver/kusen-silver-1.jpg',
                'products/gallery/kusen-silver/kusen-silver-2.jpg',
                'products/gallery/kusen-silver/kusen-silver-3.jpg',
            ],

            'Kusen Aluminium Hitam' => [
                'products/gallery/kusen-hitam/kusen-hitam-1.jpg',
                'products/gallery/kusen-hitam/kusen-hitam-2.jpg',
            ],

            'Pintu Aluminium Minimalis' => [
                'products/gallery/pintu-minimalis/pintu-minimalis-1.jpg',
                'products/gallery/pintu-minimalis/pintu-minimalis-2.jpg',
                'products/gallery/pintu-minimalis/pintu-minimalis-3.jpg',
            ],

            'Pintu Aluminium Geser' => [
                'products/gallery/pintu-geser/pintu-geser-1.jpg',
                'products/gallery/pintu-geser/pintu-geser-2.jpg',
            ],

            'Jendela Aluminium Modern' => [
                'products/gallery/jendela-modern/jendela-modern-1.jpg',
                'products/gallery/jendela-modern/jendela-modern-2.jpg',
            ],

            'Jendela Aluminium Putih' => [
                'products/gallery/jendela-putih/jendela-putih-1.jpg',
                'products/gallery/jendela-putih/jendela-putih-2.jpg',
            ],
        ];

        foreach ($productImages as $productName => $images) {

            $product = Product::where('name', $productName)->first();

            if (!$product) {
                continue;
            }

            foreach ($images as $index => $image) {

                ProductImage::create([
                    'product_id' => $product->id,

                    'image' => $image,

                    'alt_text' => $product->name . ' gallery image ' . ($index + 1),
                ]);
            }
        }
    }
}
