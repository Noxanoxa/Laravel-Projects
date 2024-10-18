<?php

namespace Database\Seeders;

use App\Models\Issue;
use App\Models\Volume;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class IssuesTableSeeder extends Seeder
{
    public function run()
    {
        $volumes = Volume::all();


        foreach ($volumes as $volume) {
            $randomDay = Arr::random(range(1, 28));
            $issueDate = Carbon::create($volume->year, 1, $randomDay);
            $numIssues = rand(1, 4); // Generate a random number of issues between 1 and 4
            for ($j = 1; $j <= $numIssues; $j++) {
                $issue = Issue::create([
                    'issue_number' => $j,
                    'issue_date' => $issueDate->toDateString(),
                    'volume_id' => $volume->id,
                ]);
                $issueDate->addMonths(6);

            }
        }
    }
}
