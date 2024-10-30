<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Issue;
use App\Models\Post;
use App\Models\User;
use App\Models\Volume;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $volumes = Volume::toBase()->get();
        $categories = Category::all()->modelKeys();
        $users = User::where('id', '>', 2)->get()->modelKeys();
        $posts = [];

        foreach ($volumes as $volume) {
            $volumeIssues = Issue::where('volume_id', $volume->id)->get();
            foreach ($volumeIssues as $issue) {
                for ($i = 0; $i < 10; $i++) {
                    $post_title = $faker->sentence(mt_rand(3, 6), true);
                    $post_title_en = $faker->sentence(mt_rand(3, 6), true);

                    $slug = Str::slug($post_title);
                    $slug_en = Str::slug($post_title_en);

                    $original_slug = $slug;
                    $original_slug_en = $slug_en;
                    $counter = 1;

                    while (Post::where('slug', $slug)->exists()) {
                        $slug = $original_slug . '-' . $counter++;
                    }

                    $counter = 1;
                    while (Post::where('slug_en', $slug_en)->exists()) {
                        $slug_en = $original_slug_en . '-' . $counter++;
                    }

                    $post = Post::create([
                        'title' => $post_title,
                        'title_en' => $post_title_en,
                        'slug' => $slug,
                        'slug_en' => $slug_en,
                        'description' => $faker->paragraph(),
                        'description_en' => $faker->paragraph(),
                        'status' => rand(0, 1),
                        'category_id' => Arr::random($categories),
                        'volume_id' => $volume->id,
                        'issue_id' => $issue->id,
                        'published_at' => $issue->issue_date,
                        'created_at' => now(),
                    ]);

                    $post->authors()->attach(Arr::random($users, rand(1, 3)));
                }
            }
        }
    }
}
