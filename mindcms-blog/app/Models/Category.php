<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Category extends Model
{
    use HasFactory, Sluggable, SearchableTrait;
    protected $guarded = [];

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
            'categories.name' => 10,
            'categories.slug' => 10,
        ],
    ];


    public  function  scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function status()
    {
        return $this->status == 1 ? __('Backend/pages.active') : __('Backend/pages.inactive');
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
