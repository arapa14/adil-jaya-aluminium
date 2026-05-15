<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use App\Models\PortfolioImage;

class PortfolioImageSeeder extends Seeder
{
    public function run(): void
    {
        $portfolioImages = [

            'Pemasangan Kusen Aluminium Rumah Minimalis' => [
                'portfolios/gallery/rumah-minimalis/rumah-minimalis-1.jpg',
                'portfolios/gallery/rumah-minimalis/rumah-minimalis-2.jpg',
                'portfolios/gallery/rumah-minimalis/rumah-minimalis-3.jpg',
            ],

            'Jendela Aluminium Modern Residence' => [
                'portfolios/gallery/jendela-modern/jendela-modern-1.jpg',
                'portfolios/gallery/jendela-modern/jendela-modern-2.jpg',
                'portfolios/gallery/jendela-modern/jendela-modern-3.jpg',
            ],

            'Facade Kaca Gedung Office Tower' => [
                'portfolios/gallery/office-tower/office-tower-1.jpg',
                'portfolios/gallery/office-tower/office-tower-2.jpg',
                'portfolios/gallery/office-tower/office-tower-3.jpg',
            ],

            'Partisi Aluminium Kantor Modern' => [
                'portfolios/gallery/partisi-kantor/partisi-kantor-1.jpg',
                'portfolios/gallery/partisi-kantor/partisi-kantor-2.jpg',
                'portfolios/gallery/partisi-kantor/partisi-kantor-3.jpg',
            ],

            'Pintu Aluminium Ruko Premium' => [
                'portfolios/gallery/ruko-premium/ruko-premium-1.jpg',
                'portfolios/gallery/ruko-premium/ruko-premium-2.jpg',
                'portfolios/gallery/ruko-premium/ruko-premium-3.jpg',
            ],

            'Kaca Tempered Cafe Minimalis' => [
                'portfolios/gallery/cafe-minimalis/cafe-minimalis-1.jpg',
                'portfolios/gallery/cafe-minimalis/cafe-minimalis-2.jpg',
                'portfolios/gallery/cafe-minimalis/cafe-minimalis-3.jpg',
            ],
        ];

        foreach ($portfolioImages as $portfolioTitle => $images) {

            $portfolio = Portfolio::where('title', $portfolioTitle)->first();

            if (!$portfolio) {
                continue;
            }

            foreach ($images as $index => $image) {

                PortfolioImage::create([

                    'portfolio_id' => $portfolio->id,

                    'image' => $image,

                    'alt_text' => $portfolio->title . ' gallery image ' . ($index + 1),
                ]);
            }
        }
    }
}