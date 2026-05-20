<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['title' => 'Pemasangan Kusen Aluminium'],
            ['title' => 'Pemasangan Pintu Aluminium'],
            ['title' => 'Pemasangan Jendela Aluminium'],
            ['title' => 'Instalasi Kaca Tempered'],
            ['title' => 'Partisi Aluminium Kantor'],
            ['title' => 'Canopy Aluminium Modern'],
        ];

        foreach ($services as $service) {
            $slug = Str::slug($service['title']);

            Service::create([
                'title' => $service['title'],
                'slug' => $slug,

                'description' => $service['title'] . ' menggunakan material berkualitas tinggi dengan pengerjaan profesional.',

                // Storage otomatis menggunakan slug
                'icon' => 'services/icons/' . $slug . '.svg',
                'thumbnail' => 'services/thumbnails/' . $slug . '-thumb.jpg',

                // Meta SEO otomatis seperti ProductSeeder
                'meta_title' => $service['title'],
                'meta_description' => $service['title'] . ' terbaik untuk kebutuhan aluminium dan kaca bangunan modern.',
                'meta_keywords' => strtolower($service['title']) . ', aluminium, kaca',
                'focus_keyword' => strtolower($service['title']),

                'og_image' => 'services/thumbnails/' . $slug . '-thumb.jpg',

                'created_by' => 1, // Ditambahkan jika ada log user di Service Anda
            ]);
        }
    }
}
