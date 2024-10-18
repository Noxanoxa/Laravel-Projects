<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Post extends Model
{
    use HasFactory, Sluggable, SearchableTrait;


    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'slug_en',
        'description',
        'description_en',
        'status',
        'post_type',
        'user_id',
        'category_id',
        'volume_id', // Ensure these fields are fillable
        'issue_id',  // Ensure these fields are fillable
    ];


    /**
     * Return the sluggable configuration array for this model.
     *
     *  @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
            'slug_en' => [
                'source' => 'title_en',
            ],
        ];
    }

    protected $searchable = [
        'columns' => [
            'posts.title'       => 10,
            'posts.title_en'    => 10,
        ],
    ];

    public function  scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function  scopePost($query)
    {
        return $query->where('post_type', 'post');
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags');
    }
    public function status(){
        return $this->status == 1 ? __('Backend/posts.active') : __('Backend/posts.inactive');
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


    public function volume()
    {
        return $this->belongsTo(Volume::class);
    }

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
