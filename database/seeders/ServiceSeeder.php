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
            [
                'title' => 'Konsultasi',
                'description' => 'Membantu pelanggan menentukan desain, model, dan jenis aluminium yang sesuai dengan kebutuhan bangunan dan anggaran.',
            ],
            [
                'title' => 'Survey',
                'description' => 'Melakukan pengecekan dan pengukuran langsung ke lokasi untuk memastikan hasil pemasangan presisi dan sesuai kebutuhan.',
            ],
            [
                'title' => 'Pemasangan',
                'description' => 'Proses instalasi aluminium dilakukan oleh tenaga profesional dengan hasil rapi, kuat, dan sesuai standar.',
            ],
            [
                'title' => 'Servis',
                'description' => 'Menangani berbagai perbaikan pada pintu, jendela, rel sliding, engsel, dan komponen aluminium lainnya.',
            ],
            [
                'title' => 'Maintenance',
                'description' => 'Perawatan berkala untuk menjaga kualitas, fungsi, dan tampilan aluminium tetap awet dan optimal.',
            ],
            [
                'title' => 'Custom',
                'description' => 'Pembuatan produk aluminium sesuai ukuran, model, dan desain yang diinginkan pelanggan.',
            ],
            [
                'title' => 'Garansi',
                'description' => 'Memberikan jaminan kualitas pengerjaan dan dukungan layanan setelah pemasangan selesai.',
            ],
        ];

        foreach ($services as $service) {
            $slug = Str::slug($service['title']);

            Service::create([
                'title' => $service['title'],
                'slug' => $slug,

                'description' => $service['description'],

                // Storage otomatis menggunakan slug
                'thumbnail' => 'services/thumbnails/' . $slug . '-thumb.jpg',

                // Meta SEO otomatis seperti ProductSeeder
                'meta_title' => $service['title'],
                'meta_description' => $service['description'],
                'meta_keywords' => strtolower($service['title']) . ', aluminium, kaca',
                'focus_keyword' => strtolower($service['title']),

                'og_image' => 'services/thumbnails/' . $slug . '-thumb.jpg',

                'created_by' => 1,
            ]);
        }
    }
}
