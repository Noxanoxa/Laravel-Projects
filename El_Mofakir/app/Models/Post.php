<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Nicolaslopezj\Searchable\SearchableTrait;
use Stevebauman\Purify\Facades\Purify;

class Post extends Model
{

    use HasFactory, Sluggable, SearchableTrait;

    protected $fillable
        = [
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
            'volume_id',
            'issue_id',
        ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug'    => [
                'source' => 'title',
            ],
            'slug_en' => [
                'source' => 'title_en',
            ],
        ];
    }

    protected $searchable
        = [
            'columns' => [
                'posts.title'    => 10,
                'posts.title_en' => 10,
            ],
        ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopePost($query)
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

    public function status()
    {
        return $this->status == 1
            ? __('Backend/posts.active')
            : __(
                'Backend/posts.inactive'
            );
    }

    public function title()
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
        return config('app.locale') == 'ar' ? $this->description
            : $this->description_en;
    }

    public function volume()
    {
        return $this->belongsTo(Volume::class);
    }

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public static function getPosts($filters, $pagination)
    {
        return self::with(['media', 'user'])
                   ->post()
                   ->when(
                       isset($filters['keyword']) && $filters['keyword'] != '',
                       function ($query) use ($filters) {
                           $query->search($filters['keyword']);
                       }
                   )
                   ->when(
                       isset($filters['volume_id']) && $filters['volume_id'] != '',
                       function ($query) use ($filters) {
                           $query->whereVolumeId($filters['volume_id']);
                       }
                   )
                   ->when(
                       isset($filters['issue_id']) && $filters['issue_id'] != '',
                       function ($query) use ($filters) {
                           $query->whereIssueId($filters['issue_id']);
                       }
                   )
                   ->when(
                       isset($filters['category_id']) && $filters['category_id'] != '',
                       function ($query) use ($filters) {
                           $query->whereCategoryId($filters['category_id']);
                       }
                   )
                   ->when(
                       isset($filters['tag_id']) && $filters['tag_id'] != '',
                       function ($query) use ($filters) {
                           $query->whereRelation('tags', 'id', $filters['tag_id']);
                       }
                   )
                   ->when(
                       isset($filters['status']) && $filters['status'] != '',
                       function ($query) use ($filters) {
                           $query->whereStatus($filters['status']);
                       }
                   )
                   ->orderBy(
                       $filters['sort_by'] ?? 'id',
                       $filters['order_by'] ?? 'desc'
                   )
                   ->paginate($pagination['limit_by'] ?? 10)
                   ->withQueryString();
    }

    public static function createPost($data, $user)
    {
        $data['description']    = Purify::clean($data['description']);
        $data['description_en'] = Purify::clean($data['description_en']);
        $data['post_type']      = 'post';

        return $user->posts()->create($data);
    }

    public function updatePost($data)
    {
        $data['description']    = Purify::clean($data['description']);
        $data['description_en'] = Purify::clean($data['description_en']);
        $data['slug']           = null;
        $data['slug_en']        = null;

        return $this->update($data);
    }

    public function addMedia($files)
    {
        foreach ($files as $file) {
            $filename  = $this->slug . '-' . time() . '-' . uniqid() . '.'
                         . $file->getClientOriginalExtension();
            $file_size = $file->getSize();
            $file_type = $file->getMimeType();
            $file->move(public_path('assets/posts'), $filename);

            $this->media()->create([
                'file_name'      => $filename,
                'real_file_name' => $file->getClientOriginalName(),
                'file_size'      => $file_size,
                'file_type'      => $file_type,
            ]);
        }
    }

    public function removeMedia()
    {
        if ($this->media->count() > 0) {
            foreach ($this->media as $media) {
                if (File::exists('assets/posts/' . $media->file_name)) {
                    unlink('assets/posts/' . $media->file_name);
                }
            }
        }
    }

    public function syncTags($tags)
    {
        $new_tags = [];
        foreach ($tags as $tag) {
            $tag        = Tag::firstOrCreate([
                'id' => $tag,
            ], [
                'name'    => $tag,
                'name_en' => $tag,
            ]);
            $new_tags[] = $tag->id;
        }
        $this->tags()->sync($new_tags);
    }

}
