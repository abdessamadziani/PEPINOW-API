<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories=["Botanique","Fleurs","Arbre","Tropicale"];
        foreach ($categories as $cat) {
          Category::insert([
                'category' => $cat,
            ]);
        }

        // Category::create([
        //     'category' => 'Category 2',
        // ]);
        // Category::create([
        //     'category' => 'Category 3',
        // ]);
        // Category::create([
        //     'category' => 'Category 4',
        // ]);
        // Category::create([
        //     'category' => 'Category 5',
        // ]);
        // Category::create([
        //     'category' => 'Category 6',
        //     'vendeur_id' => 6,
        // ]);
        // Category::create([
        //     'category' => 'Category 7',
        //     'vendeur_id' => 7,
        // ]);
    }
}
