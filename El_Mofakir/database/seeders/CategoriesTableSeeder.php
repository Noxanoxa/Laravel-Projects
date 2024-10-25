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
        Category::create([ 'name' => 'قانون', 'name_en' => 'Law', 'status'=> 1 ]);
        Category::create([ 'name' => 'سياسة' , 'name_en' => 'Politics', 'status'=> 1 ]);
        Category::create([ 'name' => 'اقتصاد', 'name_en' => 'Economy', 'status'=> 1 ]);
        Category::create([ 'name' => 'شوؤن دولية', 'name_en' => 'International Affairs', 'status'=> 1 ]);
        Category::create([ 'name' => 'ثقافة', 'name_en' => 'Culture', 'status'=> 1 ]);
    }
}
