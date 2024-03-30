<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Bunga Tangkai',
        ]);
        
        Category::create([
            'name' => 'Bunga Hidup',
        ]);
        
        Category::create([
            'name' => 'Bunga Papan',
        ]);

        Product::factory(30)->create();
    }
}
