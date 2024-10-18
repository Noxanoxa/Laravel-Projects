<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Post;


class LastPostComments extends Component
{
    public function render()
    {
        $posts = Post::post()->orderBy('id', 'desc')->take(5)->get();
        return view('livewire.backend.last-post-comments', [
            'posts' => $posts,

        ]);
    }
}
