<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,

            ProductCategorySeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,

            PortfolioCategorySeeder::class,
            PortfolioSeeder::class,
            PortfolioImageSeeder::class,
        ]);
    }
}
