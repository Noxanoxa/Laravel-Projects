<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    protected $guarded = [];

    public function post()
    {
        return $this->blengsTo(Post::class);
    }
}
