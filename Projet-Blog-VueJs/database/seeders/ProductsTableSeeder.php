<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Scented Candle - Vanilla',
                'description' => 'A soothing vanilla-scented candle for a relaxing atmosphere.',
                'image' => 'https://via.placeholder.com/100',
                'categorie' => 'Home & Decor',
                'quality' => 30,
                'price' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lavender Relaxing Candle',
                'description' => 'Lavender-infused candle perfect for stress relief and sleep.',
                'image' => 'https://via.placeholder.com/100',
                'categorie' => 'Aromatherapy',
                'quality' => 50,
                'price' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rose Blossom Candle',
                'description' => 'A floral-scented candle with natural rose fragrance.',
                'image' => 'https://via.placeholder.com/100',
                'categorie' => 'Floral',
                'quality' => 25,
                'price' => 140,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Citrus Energy Candle',
                'description' => 'Energizing citrus candle to refresh your space.',
                'image' => 'https://via.placeholder.com/100',
                'categorie' => 'Citrus',
                'quality' => 40,
                'price' => 130,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Woodland Pine Candle',
                'description' => 'Earthy pine-scented candle for a fresh outdoor feel.',
                'image' => 'https://via.placeholder.com/100',
                'categorie' => 'Nature',
                'quality' => 35,
                'price' => 160,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jasmine Dream Candle',
                'description' => 'Jasmine-scented candle to enhance relaxation and calmness.',
                'image' => 'https://via.placeholder.com/100',
                'categorie' => 'Floral',
                'quality' => 20,
                'price' => 145,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ocean Breeze Candle',
                'description' => 'Fresh ocean-inspired fragrance for a calming effect.',
                'image' => 'https://via.placeholder.com/100',
                'categorie' => 'Fresh',
                'quality' => 50,
                'price' => 135,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cinnamon Spice Candle',
                'description' => 'Warm cinnamon aroma for cozy autumn vibes.',
                'image' => 'https://via.placeholder.com/100',
                'categorie' => 'Spice',
                'quality' => 30,
                'price' => 125,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
