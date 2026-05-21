<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [

            [
                'customer_name' => 'Budi Santoso',
                'project_type' => 'Pemasangan Kusen Aluminium',
                'rating' => 5,
                'message' => 'Hasil pemasangan kusen aluminium sangat rapi dan presisi. Tim bekerja profesional, cepat, dan material yang digunakan berkualitas tinggi.',
            ],

            [
                'customer_name' => 'Andi Wijaya',
                'project_type' => 'Pintu Aluminium Minimalis',
                'rating' => 5,
                'message' => 'Desain pintu aluminium modern sesuai ekspektasi. Proses pengerjaan cepat dan hasil finishing sangat memuaskan.',
            ],

            [
                'customer_name' => 'Siti Rahma',
                'project_type' => 'Jendela Aluminium Rumah',
                'rating' => 4,
                'message' => 'Pelayanan ramah dan responsif saat konsultasi desain. Hasil jendela aluminium terlihat elegan dan kokoh.',
            ],

            [
                'customer_name' => 'Michael Tan',
                'project_type' => 'Partisi Aluminium Kantor',
                'rating' => 5,
                'message' => 'Project partisi kantor selesai tepat waktu dengan hasil modern dan premium. Sangat cocok untuk interior kantor minimalis.',
            ],

            [
                'customer_name' => 'Dewi Lestari',
                'project_type' => 'Instalasi Kaca Tempered Cafe',
                'rating' => 5,
                'message' => 'Kualitas kaca tempered sangat bagus dan pemasangan sangat detail. Tampilan cafe menjadi lebih modern dan mewah.',
            ],

            [
                'customer_name' => 'Rizky Pratama',
                'project_type' => 'Canopy Aluminium Modern',
                'rating' => 4,
                'message' => 'Harga kompetitif dengan kualitas pengerjaan yang sangat baik. Canopy terlihat kuat dan estetik.',
            ],
        ];

        foreach ($testimonials as $testimonial) {

            $slug = Str::slug($testimonial['customer_name']);

            Testimonial::create([
                'customer_name' => $testimonial['customer_name'],

                'project_type' => $testimonial['project_type'],

                'rating' => $testimonial['rating'],

                'message' => $testimonial['message'],

                // otomatis generate lokasi photo
                'photo' => 'testimonials/' . $slug . '.jpg',

                'status' => true,

                // optional created_by
                'created_by' => 1,
            ]);
        }
    }
}
