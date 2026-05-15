<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [

            [
                'customer_name' => 'Budi Santoso',
                'project_type' => 'Pemasangan Kusen Aluminium',
                'rating' => 5,
                'message' => 'Hasil pengerjaan sangat rapi dan profesional. Material aluminium berkualitas dan pemasangan tepat waktu.',
                'photo' => 'testimonials/budi-santoso.jpg',
            ],

            [
                'customer_name' => 'Andi Wijaya',
                'project_type' => 'Pintu Aluminium Minimalis',
                'rating' => 5,
                'message' => 'Pelayanan sangat memuaskan, desain modern dan sesuai ekspektasi. Recommended untuk kebutuhan rumah.',
                'photo' => 'testimonials/andi-wijaya.jpg',
            ],

            [
                'customer_name' => 'Siti Rahma',
                'project_type' => 'Jendela Aluminium',
                'rating' => 4,
                'message' => 'Pengerjaan cepat dan hasil bagus. Tim juga responsif saat konsultasi desain.',
                'photo' => 'testimonials/siti-rahma.jpg',
            ],

            [
                'customer_name' => 'Michael Tan',
                'project_type' => 'Partisi Kantor Aluminium',
                'rating' => 5,
                'message' => 'Project kantor selesai tepat waktu dengan hasil modern dan elegan. Sangat puas dengan kualitasnya.',
                'photo' => 'testimonials/michael-tan.jpg',
            ],

            [
                'customer_name' => 'Dewi Lestari',
                'project_type' => 'Kaca Tempered Cafe',
                'rating' => 5,
                'message' => 'Kualitas kaca dan finishing sangat premium. Cocok untuk konsep cafe minimalis modern.',
                'photo' => 'testimonials/dewi-lestari.jpg',
            ],

            [
                'customer_name' => 'Rizky Pratama',
                'project_type' => 'Canopy Aluminium',
                'rating' => 4,
                'message' => 'Harga kompetitif dengan hasil yang sangat baik. Proses instalasi juga cukup cepat.',
                'photo' => 'testimonials/rizky-pratama.jpg',
            ],
        ];

        foreach ($testimonials as $testimonial) {

            Testimonial::create([

                'customer_name' => $testimonial['customer_name'],

                'project_type' => $testimonial['project_type'],

                'rating' => $testimonial['rating'],

                'message' => $testimonial['message'],

                'photo' => $testimonial['photo'],
            ]);
        }
    }
}
