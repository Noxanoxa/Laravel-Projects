<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Comment extends Model
{
    use SearchableTrait;
    protected $searchable = [
        'columns' => [
            'comments.name' => 10,
            'comments.email' => 10,
            'comments.url' => 10,
            'comments.ip_address' => 10,
            'comments.comment' => 10,
        ],
    ];
    protected $guarded = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function status(){
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
