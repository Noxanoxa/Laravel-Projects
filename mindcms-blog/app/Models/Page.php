<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Page extends Model
{
    use HasFactory, Sluggable, SearchableTrait;

    protected $table = 'posts';
    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     *  @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ],
            'slug_en' => [
                'source' => 'title_en',
            ],
        ];
    }

    protected $searchable = [
        'columns' => [
            'posts.title' => 10,
            'posts.title_en' => 10,
            'posts.description' => 10,
            'posts.description_en' => 10,
        ],
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function media()
    {
        return $this->hasMany(PostMedia::class, 'post_id', 'id');
    }
    public function status(){
        return $this->status == 1 ?   __('Backend/pages.active') : __('Backend/pages.inactive');
    }

    public function title ()
    {
        return config('app.locale') == 'ar' ? $this->title : $this->title_en;
    }

    // url_slug instead slug because of conflict with sluggable package
    public function url_slug()
    {
        return config('app.locale') == 'ar' ? $this->slug : $this->slug_en;
    }

    public function description()
    {
        return config('app.locale') == 'ar' ? $this->description : $this->description_en;
    }


}
