<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Tag extends Model
{
    use HasFactory, Sluggable, SearchableTrait;

    protected $guarded =[];

    public function sluggable(): array
    {
    return [
        'slug' => [
            'source' => 'name',
        ],
        'slug_en' => [
            'source' => 'name_en',
        ],
    ];
    }

    protected $searchable = [
        'columns' => [
            'tags.name' => 10,
            'tags.name_en' => 10,
        ],
    ];

    public function  posts()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags');
    }

    public function name ()
    {
        return config('app.locale') == 'ar' ? $this->name : $this->name_en;
    }

    // url_slug instead slug because of conflict with sluggable package
    public function url_slug()
    {
        return config('app.locale') == 'ar' ? $this->slug : $this->slug_en;
    }

}
