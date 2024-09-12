<?php

namespace App\Http\Resources\General;

use App\Http\Resources\Users\UsersPostsMediaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'url' => route('frontend.posts.show', $this->slug),
            'description' => $this->description,
            'status' => $this->status(),
            'comment_able' => $this->comment_able,
            'comments_count' => $this->comments->where('status', 1)->count(),
            'created_date' => $this->created_at->format('d-m-Y h:i a'),
            'author' => new UsersResource($this->user),
            'category' => new CategoriesResource($this->category), // in this case category as one  element
            'tags' => TagsResource::collection($this->tags), // in this case tags as multiple elements
            'media' => UsersPostsMediaResource::collection($this->media), // in this case media as multiple elements


        ];
    }
}
