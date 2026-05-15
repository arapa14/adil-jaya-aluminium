<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $galleries = [

            // PRODUCT
            [
                'image' => 'galleries/products/kusen-aluminium.jpg',
                'type' => 'product',
                'caption' => 'Produk kusen aluminium premium',
                'alt_text' => 'Kusen aluminium premium modern',
            ],

            [
                'image' => 'galleries/products/pintu-aluminium.jpg',
                'type' => 'product',
                'caption' => 'Pintu aluminium minimalis',
                'alt_text' => 'Pintu aluminium minimalis modern',
            ],

            // PORTFOLIO
            [
                'image' => 'galleries/portfolios/rumah-minimalis.jpg',
                'type' => 'portfolio',
                'caption' => 'Project rumah minimalis Jakarta',
                'alt_text' => 'Portfolio rumah minimalis aluminium',
            ],

            [
                'image' => 'galleries/portfolios/office-tower.jpg',
                'type' => 'portfolio',
                'caption' => 'Facade kaca gedung perkantoran',
                'alt_text' => 'Facade kaca gedung modern',
            ],

            // SERVICE
            [
                'image' => 'galleries/services/pemasangan-kusen.jpg',
                'type' => 'service',
                'caption' => 'Layanan pemasangan kusen aluminium',
                'alt_text' => 'Jasa pemasangan kusen aluminium',
            ],

            [
                'image' => 'galleries/services/kaca-tempered.jpg',
                'type' => 'service',
                'caption' => 'Instalasi kaca tempered',
                'alt_text' => 'Pemasangan kaca tempered modern',
            ],

            // BANNER
            [
                'image' => 'galleries/banners/banner-1.jpg',
                'type' => 'banner',
                'caption' => 'Banner homepage utama',
                'alt_text' => 'Banner aluminium dan kaca modern',
            ],

            [
                'image' => 'galleries/banners/banner-2.jpg',
                'type' => 'banner',
                'caption' => 'Banner promo layanan',
                'alt_text' => 'Banner promo jasa aluminium',
            ],

            // TESTIMONIAL
            [
                'image' => 'galleries/testimonials/customer-1.jpg',
                'type' => 'testimonial',
                'caption' => 'Customer puas project rumah',
                'alt_text' => 'Customer testimonial aluminium',
            ],

            // COMPANY
            [
                'image' => 'galleries/company/workshop.jpg',
                'type' => 'company',
                'caption' => 'Workshop Adil Jaya Aluminium',
                'alt_text' => 'Workshop aluminium modern',
            ],

            [
                'image' => 'galleries/company/team.jpg',
                'type' => 'company',
                'caption' => 'Tim profesional Adil Jaya Aluminium',
                'alt_text' => 'Team perusahaan aluminium',
            ],

            // GENERAL GALLERY
            [
                'image' => 'galleries/general/gallery-1.jpg',
                'type' => 'gallery',
                'caption' => 'Gallery project aluminium',
                'alt_text' => 'Gallery aluminium modern',
            ],

            [
                'image' => 'galleries/general/gallery-2.jpg',
                'type' => 'gallery',
                'caption' => 'Hasil pemasangan kaca dan aluminium',
                'alt_text' => 'Hasil project aluminium dan kaca',
            ],
        ];

        foreach ($galleries as $gallery) {

            Gallery::create([

                'image' => $gallery['image'],

                'type' => $gallery['type'],

                'caption' => $gallery['caption'],

                'alt_text' => $gallery['alt_text'],
            ]);
        }
    }
}
