<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([ 'name' => 'un-categorized', 'status'=> 1 ]);
        Category::create([ 'name' => 'Natural', 'status'=> 1 ]);
        Category::create([ 'name' => 'Flowers', 'status'=> 1 ]);
        Category::create([ 'name' => 'Kitchen', 'status'=> 0 ]);
    }
}
