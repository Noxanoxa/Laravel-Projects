<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'زهور', 'name_en' => 'Flowers']);
        Tag::create(['name' => 'طبيعة سجية', 'name_en' => 'Nature']);
        Tag::create(['name' => 'الكتروني', 'name_en' => 'Animals']);
        Tag::create(['name' => 'السفر', 'name_en' => 'Travel']);
        Tag::create(['name' => 'طعام', 'name_en' => 'Food']);
        Tag::create(['name' => 'نمط حياة', 'name_en' => 'Lifestyle']);
        Tag::create(['name' => 'موضة', 'name_en' => 'Fashion']);
    }
}
