<?php

namespace App\Http\Livewire\Backend;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Statistics extends Component
{

    public function render()
    {
        $all_users = User::whereRelation('roles', 'name', 'user')->active()
                         ->count();

        $active_posts   = Post::active()->post()->count();
        $inactive_posts = Post::whereStatus(0)->post()->count();

        return view('livewire.backend.statistics', [
            'all_users'      => $all_users,
            'active_posts'   => $active_posts,
            'inactive_posts' => $inactive_posts,
        ]);
    }

}
