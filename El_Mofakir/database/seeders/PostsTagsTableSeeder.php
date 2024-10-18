<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class PostsTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            $tags = Tag::inRandomOrder()->take(3)->pluck('id')->toArray();
            $post->tags()->sync($tags);
        }
    }
}
