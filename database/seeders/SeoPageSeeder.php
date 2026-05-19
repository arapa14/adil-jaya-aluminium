<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\SeoPage;

class SeoPageSeeder extends Seeder
{
    public function run(): void
    {
        $seoPages = [

            [
                'page_name' => 'Home',
                'slug' => '/',

                'meta_title' => 'Adil Jaya Aluminium | Jasa Aluminium dan Kaca Modern',

                'meta_description' => 'Adil Jaya Aluminium melayani pemasangan kusen aluminium, kaca tempered, pintu aluminium, dan berbagai kebutuhan bangunan modern.',

                'meta_keywords' => 'aluminium, kaca tempered, kusen aluminium, jasa aluminium jakarta',

                'focus_keyword' => 'jasa aluminium jakarta',

                'og_title' => 'Adil Jaya Aluminium',

                'og_description' => 'Jasa pemasangan aluminium dan kaca modern berkualitas.',

                'og_image' => 'seo/630x1200.png',

                'canonical_url' => 'https://adiljayaaluminium.com/',

                'robots_index' => 'index',

                'robots_follow' => 'follow',

                'schema_markup' => json_encode([
                    "@context" => "https://schema.org",
                    "@type" => "LocalBusiness",
                    "name" => "Adil Jaya Aluminium",
                    "address" => [
                        "@type" => "PostalAddress",
                        "addressLocality" => "Jakarta"
                    ],
                    "telephone" => "+628123456789"
                ]),
            ],

            [
                'page_name' => 'About Us',
                'slug' => 'about',

                'meta_title' => 'Tentang Kami | Adil Jaya Aluminium',

                'meta_description' => 'Mengenal lebih dekat Adil Jaya Aluminium sebagai jasa aluminium dan kaca terpercaya.',

                'meta_keywords' => 'tentang perusahaan aluminium, jasa aluminium terpercaya',

                'focus_keyword' => 'tentang adil jaya aluminium',

                'og_title' => 'Tentang Kami - Adil Jaya Aluminium',

                'og_description' => 'Profil perusahaan aluminium dan kaca modern.',

                'og_image' => 'seo/630x1200.png',

                'canonical_url' => 'https://adiljayaaluminium.com/about-us',

                'robots_index' => 'index',

                'robots_follow' => 'follow',

                'schema_markup' => null,
            ],

            [
                'page_name' => 'Services',
                'slug' => 'services',

                'meta_title' => 'Layanan Aluminium dan Kaca | Adil Jaya Aluminium',

                'meta_description' => 'Layanan pemasangan kusen aluminium, kaca tempered, partisi kantor, dan canopy modern.',

                'meta_keywords' => 'layanan aluminium, kaca tempered, canopy aluminium',

                'focus_keyword' => 'layanan aluminium jakarta',

                'og_title' => 'Layanan Adil Jaya Aluminium',

                'og_description' => 'Berbagai layanan aluminium dan kaca profesional.',

                'og_image' => 'seo/630x1200.png',

                'canonical_url' => 'https://adiljayaaluminium.com/services',

                'robots_index' => 'index',

                'robots_follow' => 'follow',

                'schema_markup' => null,
            ],

            [
                'page_name' => 'Portfolio',
                'slug' => 'portfolio',

                'meta_title' => 'Portfolio Project Aluminium | Adil Jaya Aluminium',

                'meta_description' => 'Portfolio project aluminium dan kaca modern untuk rumah, kantor, dan bangunan komersial.',

                'meta_keywords' => 'portfolio aluminium, project kaca modern',

                'focus_keyword' => 'portfolio aluminium jakarta',

                'og_title' => 'Portfolio Adil Jaya Aluminium',

                'og_description' => 'Hasil project aluminium dan kaca berkualitas.',

                'og_image' => 'seo/630x1200.png',

                'canonical_url' => 'https://adiljayaaluminium.com/portfolio',

                'robots_index' => 'index',

                'robots_follow' => 'follow',

                'schema_markup' => null,
            ],

            [
                'page_name' => 'Contact',
                'slug' => 'contact',

                'meta_title' => 'Kontak Kami | Adil Jaya Aluminium',

                'meta_description' => 'Hubungi Adil Jaya Aluminium untuk konsultasi dan pemasangan aluminium berkualitas.',

                'meta_keywords' => 'kontak jasa aluminium, jasa kaca jakarta',

                'focus_keyword' => 'kontak adil jaya aluminium',

                'og_title' => 'Kontak Adil Jaya Aluminium',

                'og_description' => 'Hubungi kami untuk kebutuhan aluminium dan kaca modern.',

                'og_image' => 'seo/630x1200.png',

                'canonical_url' => 'https://adiljayaaluminium.com/contact',

                'robots_index' => 'index',

                'robots_follow' => 'follow',

                'schema_markup' => null,
            ],
        ];

        foreach ($seoPages as $page) {

            SeoPage::create([

                'page_name' => $page['page_name'],

                'slug' => $page['slug'],

                'meta_title' => $page['meta_title'],

                'meta_description' => $page['meta_description'],

                'meta_keywords' => $page['meta_keywords'],

                'focus_keyword' => $page['focus_keyword'],

                'og_title' => $page['og_title'],

                'og_description' => $page['og_description'],

                'og_image' => $page['og_image'],

                'canonical_url' => $page['canonical_url'],

                'robots_index' => $page['robots_index'],

                'robots_follow' => $page['robots_follow'],

                'schema_markup' => $page['schema_markup'],
            ]);
        }
    }
}
