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
        Category::create([ 'name' => 'غير مصنف', 'name_en' => 'un-categorized', 'status'=> 1 ]);
        Category::create([ 'name' => 'طبيعية', 'name_en' => 'Natural', 'status'=> 1 ]);
        Category::create([ 'name' => 'ورود', 'name_en' => 'Flowers', 'status'=> 1 ]);
        Category::create([ 'name' => 'مطابخ', 'name_en' => 'Kitchen', 'status'=> 0 ]);
    }
}
