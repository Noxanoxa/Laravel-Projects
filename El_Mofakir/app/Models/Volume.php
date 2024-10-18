<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Volume extends Model
{
    use HasFactory, SearchableTrait;

    protected $fillable = ['number', 'year', 'status'];

    protected $searchable = [
        'columns' => [
            'volumes.number' => 10,
            'volumes.year' => 10,
        ],
    ];

    public function status()
    {
        return $this->status == 1 ? __('Backend/volumes.active') : __('Backend/volumes.inactive');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
    }

    public function posts()
    {
        return $this->hasManyThrough(Post::class, Issue::class);
    }
}
