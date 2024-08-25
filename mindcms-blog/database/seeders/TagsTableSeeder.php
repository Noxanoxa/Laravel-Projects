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
        Tag::create(['name' => 'Flowers']);
        Tag::create(['name' => 'Nature']);
        Tag::create(['name' => 'Animals']);
        Tag::create(['name' => 'Travel']);
        Tag::create(['name' => 'Food']);
        Tag::create(['name' => 'Lifestyle']);
        Tag::create(['name' => 'Fashion']);
    }
}
