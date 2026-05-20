<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [

            [
                'title' => 'Produk Kusen Aluminium Premium',
            ],

            [
                'title' => 'Pintu Aluminium Minimalis',
            ],

            [
                'title' => 'Rumah Minimalis Jakarta',
            ],

            [
                'title' => 'Facade Kaca Gedung Perkantoran',
            ],

            [
                'title' => 'Pemasangan Kusen Aluminium',
            ],

            [
                'title' => 'Instalasi Kaca Tempered',
            ],

            [
                'title' => 'Banner Homepage Utama',
            ],

            [
                'title' => 'Banner Promo Layanan',
            ],

            [
                'title' => 'Customer Puas Project Rumah',
            ],

            [
                'title' => 'Workshop Adil Jaya Aluminium',
            ],

            [
                'title' => 'Tim Profesional Adil Jaya Aluminium',
            ],

            [
                'title' => 'Gallery Project Aluminium',
            ],

            [
                'title' => 'Hasil Pemasangan Kaca dan Aluminium',
            ],
        ];

        foreach ($galleries as $gallery) {

            /*
            |--------------------------------------------------------------------------
            | Generate Slug
            |--------------------------------------------------------------------------
            */
            $slug = Str::slug($gallery['title']);

            /*
            |--------------------------------------------------------------------------
            | Generate Image Path
            |--------------------------------------------------------------------------
            */
            $imagePath = 'galleries/' . $slug . '.jpg';

            Gallery::create([
                'image' => $imagePath,

                'caption' => $gallery['title'],

                'alt_text' => $gallery['title'],

                'status' => true,

                'created_by' => 1,
            ]);
        }
    }
}
