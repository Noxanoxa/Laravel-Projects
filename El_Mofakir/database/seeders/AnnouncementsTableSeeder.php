<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker         = Factory::create();
        $announcements = [];
        $adminUsers    = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get()->modelKeys();

        for ($i = 0; $i < 10; $i++) {
            $days                  = [
                '01', '02', '03', '04', '05', '06', '07', '08', '09', '10',
                '11', '12', '13', '14', '15', '16', '17', '18', '19', '20',
                '21', '22', '23', '24', '25', '26', '27', '28'
            ];
            $months                = [
                '01', '02', '03', '04', '05', '06', '07', '08'
            ];
            $announcement_date     = "2024-" . Arr::random($months) . "-"
                                     . Arr::random($days) . " 01:01:01";
            $announcement_title    = $faker->sentence(mt_rand(3, 6), true);
            $announcement_title_en = $faker->sentence(mt_rand(3, 6), true);

            $announcements[] = [
                'title'          => $announcement_title,
                'title_en'       => $announcement_title_en,
                'slug'           => Str::slug($announcement_title),
                'slug_en'        => Str::slug($announcement_title_en),
                'description'    => $faker->paragraph(),
                'description_en' => $faker->paragraph(),
                'status'         => rand(0, 1),
                'user_id'        => Arr::random($adminUsers),
                'created_at'     => $announcement_date,
                'updated_at'     => $announcement_date,
            ];
        }
        $chunks = array_chunk($announcements, 5);
        foreach ($chunks as $chunk) {
            Announcement::insert($chunk);
        }
    }
}
