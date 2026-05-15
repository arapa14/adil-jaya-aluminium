<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [

            [
                'title' => 'Pemasangan Kusen Aluminium',
                'icon' => 'services/icons/kusen.svg',
                'thumbnail' => 'services/thumbnails/kusen-thumb.jpg',
            ],

            [
                'title' => 'Pemasangan Pintu Aluminium',
                'icon' => 'services/icons/pintu.svg',
                'thumbnail' => 'services/thumbnails/pintu-thumb.jpg',
            ],

            [
                'title' => 'Pemasangan Jendela Aluminium',
                'icon' => 'services/icons/jendela.svg',
                'thumbnail' => 'services/thumbnails/jendela-thumb.jpg',
            ],

            [
                'title' => 'Instalasi Kaca Tempered',
                'icon' => 'services/icons/kaca.svg',
                'thumbnail' => 'services/thumbnails/kaca-thumb.jpg',
            ],

            [
                'title' => 'Partisi Aluminium Kantor',
                'icon' => 'services/icons/partisi.svg',
                'thumbnail' => 'services/thumbnails/partisi-thumb.jpg',
            ],

            [
                'title' => 'Canopy Aluminium Modern',
                'icon' => 'services/icons/canopy.svg',
                'thumbnail' => 'services/thumbnails/canopy-thumb.jpg',
            ],
        ];

        foreach ($services as $service) {

            Service::create([

                'title' => $service['title'],

                'slug' => Str::slug($service['title']),

                'description' => $service['title'] . ' menggunakan material berkualitas tinggi dengan pengerjaan profesional.',

                'icon' => $service['icon'],

                'thumbnail' => $service['thumbnail'],

                'meta_title' => $service['title'],

                'meta_description' => $service['title'] . ' terbaik untuk kebutuhan aluminium dan kaca bangunan modern.',

                'meta_keywords' => strtolower($service['title']) . ', aluminium, kaca',

                'focus_keyword' => strtolower($service['title']),

                'og_image' => $service['thumbnail'],
            ]);
        }
    }
}
