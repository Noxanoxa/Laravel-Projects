<?php

// database/seeders/IssuesTableSeeder.php

namespace Database\Seeders;

use App\Models\Issue;
use App\Models\Volume;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class IssuesTableSeeder extends Seeder
{
    public function run()
    {
        $volumes = Volume::toBase()->get();

        foreach ($volumes as $volume) {
            $issueDates = [
                Carbon::create($volume->year, 6, 1),
                Carbon::create($volume->year, 12, 1)
            ];

            foreach ($issueDates as $index => $issueDate) {
                Issue::create([
                    'issue_number' => $index + 1,
                    'issue_date' => $issueDate->toDateString(),
                    'volume_id' => $volume->id,
                ]);
            }
        }
    }
}
