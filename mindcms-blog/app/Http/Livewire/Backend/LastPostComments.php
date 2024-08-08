<?php

namespace App\Http\Livewire\Backend;

use App\Models\Comment;
use Livewire\Component;
use App\Models\Post;


class LastPostComments extends Component
{
    public function render()
    {
        $posts = Post::post()->withCount('comments')->orderBy('id', 'desc')->take(5)->get();
        $comments = Comment::orderBy('id', 'desc')->take(5)->get();
        return view('livewire.backend.last-post-comments', [
            'posts' => $posts,
            'comments' => $comments,
        ]);
    }
}
