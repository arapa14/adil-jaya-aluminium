<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [

            [
                'title' => 'Kusen UPVC Merk Conch',
            ],

            [
                'title' => 'Pintu Lipat dan Jalusi 4 Daun',
            ],

            [
                'title' => 'Pintu Lipat Sudut 5 Daun',
            ],

            [
                'title' => 'Pintu Garasi Dorong',
            ],

            [
                'title' => 'Jendela Swing Lengkung',
            ],

            [
                'title' => 'Jendela Sliding 3 Daun',
            ],
        ];

        foreach ($galleries as $gallery) {

            /*
            |--------------------------------------------------------------------------
            | Generate Slug
            |--------------------------------------------------------------------------
            */
            $slug = Str::slug($gallery['title']);

            /*
            |--------------------------------------------------------------------------
            | Generate Image Path
            |--------------------------------------------------------------------------
            */
            $imagePath = 'galleries/' . $slug . '.jpg';

            Gallery::create([
                'image' => $imagePath,

                'caption' => $gallery['title'],

                'alt_text' => $gallery['title'],

                'status' => true,

                'created_by' => 1,
            ]);
        }
    }
}
