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

            'address' => 'Jl. Pintu Air RT 03/RW 002, Kelurahan Karang Tengah, Kecamatan Karang Tengah, Kota Tangerang, Banten, Indonesia.',

            'whatsapp' => '6282188049991',

            'email' => 'Ccahyadi642@gmail.com',

            'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18..." width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',

            'facebook' => 'https://www.facebook.com/cahyadi.ilham.264705',

            'instagram' => 'https://instagram.com/adiljayaaluminium',

            'vision' => 'Menjadi penyedia jasa alumunium yang berkualitas dan terpercaya.',

            'mission' => '<ol>
<li>Menghasilkan produk berkualitas.</li>
<li>Memberikan pelayanan terbaik</li>
<li>Menjaga kepercayaan pelanggan</li>
</ol>',

            'logo' => 'settings/logo.png',

            'favicon' => 'settings/favicon.png',

            'hero_image' => 'settings/hero-section.jpeg'
        ]);
    }
}
