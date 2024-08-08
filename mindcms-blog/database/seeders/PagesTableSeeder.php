<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Page;


class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

         Page::create([
            'title' => 'About Us',
            'description' => $faker->paragraph(),
            'status' => 1,
            'comment_able' => 0,
            'post_type' => 'page',
            'user_id' => 1,
            'category_id' => 1,
        ]);


        Page::create([
            'title' => 'Our Vision',
            'description' => $faker->paragraph(),
            'status' => 1,
            'comment_able' => 0,
            'post_type' => 'page',
            'user_id' => 1,
            'category_id' => 1,
        ]);
    }

}
