<?php

namespace Database\Seeders;

use App\Models\Volume;
use Illuminate\Database\Seeder;

class VolumesTableSeeder extends Seeder
{
    public function run()
    {
        $year = 2020;
        for ($i = 1; $i <= 5; $i++) {
            Volume::create([
                'number' => $i,
                'year' => $year,
                'status' => rand(0, 1),
            ]);
            $year++;
        }
    }
}
