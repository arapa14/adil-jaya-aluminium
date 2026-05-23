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
            'Pemasangan Aluminium Perkantoran Modern' => 1,
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