<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $categories = ['Funny', 'Animals', 'Gaming', 'Movies', 'Music', 'News'];

    foreach ($categories as $categoryName) {
        Category::create(['name' => $categoryName]);
    }
}

}
