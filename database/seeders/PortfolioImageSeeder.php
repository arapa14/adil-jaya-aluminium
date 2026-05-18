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
            'Pemasangan Kusen Aluminium Rumah Minimalis' => 3,
            'Jendela Aluminium Modern Residence' => 3,
            'Facade Kaca Gedung Office Tower' => 3,
            'Partisi Aluminium Kantor Modern' => 3,
            'Pintu Aluminium Ruko Premium' => 3,
            'Kaca Tempered Cafe Minimalis' => 3,
        ];

        foreach ($portfolioImages as $portfolioTitle => $totalImages) {
            $portfolio = Portfolio::where('title', $portfolioTitle)->first();

            if (!$portfolio) {
                continue;
            }

            $slug = $portfolio->slug;

            for ($i = 1; $i <= $totalImages; $i++) {
                PortfolioImage::create([
                    'portfolio_id' => $portfolio->id,
                    'image' => 'portfolios/gallery/' . $slug . '/' . $slug . '-' . $i . '.jpg',
                    'alt_text' => $portfolio->title . ' gallery image ' . $i,
                ]);
            }
        }
    }
}