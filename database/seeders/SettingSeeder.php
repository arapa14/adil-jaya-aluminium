<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create([

            'company_name' => 'Adil Jaya Aluminium',

            'company_desc' => 'Adil Jaya Aluminium merupakan perusahaan yang bergerak di bidang pemasangan aluminium dan kaca modern untuk kebutuhan rumah, kantor, dan bangunan komersial dengan kualitas terbaik dan pengerjaan profesional.',

            'address' => 'Jl. Contoh Raya No. 123, Jakarta Pusat, DKI Jakarta, Indonesia',

            'whatsapp' => '6281234567890',

            'email' => 'info@adiljayaaluminium.com',

            'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18..." width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',

            'facebook' => 'https://facebook.com/adiljayaaluminium',

            'instagram' => 'https://instagram.com/adiljayaaluminium',

            'visson' => 'Menjadi perusahaan aluminium dan kaca terpercaya yang menghadirkan kualitas, inovasi, dan kepuasan pelanggan.',

            'mission' => 'Memberikan layanan aluminium dan kaca berkualitas tinggi dengan pengerjaan profesional, tepat waktu, dan harga kompetitif.',

            'logo' => 'settings/logo.png',

            'favicon' => 'settings/favicon.png',

            'hero_image' => 'settings/hero-section.jpeg'
        ]);
    }
}
