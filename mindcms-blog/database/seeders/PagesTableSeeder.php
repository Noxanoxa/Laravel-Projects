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
            'title' => 'نبذة عنا',
            'title_en' => 'About Us',
            'description' => $faker->paragraph(),
            'description_en' => $faker->paragraph(),
            'status' => 1,
            'comment_able' => 0,
            'post_type' => 'page',
            'user_id' => 1,
            'category_id' => 1,
        ]);


        Page::create([
            'title' => 'رؤيتنا',
            'title_en' => 'Our Vision',
            'description' => $faker->paragraph(),
            'description_en' => $faker->paragraph(),
            'status' => 1,
            'comment_able' => 0,
            'post_type' => 'page',
            'user_id' => 1,
            'category_id' => 1,
        ]);
    }

}
