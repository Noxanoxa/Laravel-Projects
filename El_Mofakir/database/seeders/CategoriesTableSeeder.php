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
        Category::create([ 'name' => 'علم سياسة والعلاقات الدولية', 'name_en' => 'Political Science and International Relations', 'status'=> 1 ]);
        Category::create([ 'name' => 'الإدارة العامة', 'name_en' => 'Public Administration', 'status'=> 1 ]);
        Category::create([ 'name' => 'الشريعة الإسلامية', 'name_en' => 'Sharia Law', 'status'=> 1 ]);
         }
}
