<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

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

    public function  scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->status == 1 ? __('Backend/posts.active') : __('Backend/posts.inactive');
    }

    public function title ()
    {
        return config('app.locale') == 'ar' ? $this->title : $this->title_en;
    }

    public function description()
    {
        return config('app.locale') == 'ar' ? $this->description : $this->description_en;
    }
    // url_slug instead slug because of conflict with sluggable package
    public function url_slug()
    {
        return config('app.locale') == 'ar' ? $this->slug : $this->slug_en;
    }

}
