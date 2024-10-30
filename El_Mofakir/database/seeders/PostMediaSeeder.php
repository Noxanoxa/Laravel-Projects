<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostMedia;
use Illuminate\Database\Seeder;

class PostMediaSeeder extends Seeder
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
            PostMedia::create([
                'post_id' => $post->id,
                'file_name' => 'default.pdf',
                'real_file_name' => 'default.pdf',
                'file_type' => 'application/pdf',
            ]);
        }
    }
}
