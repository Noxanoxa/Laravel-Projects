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
            'id' => $this->id,
            'title' => $this->title,
            'title_en' => $this->title_en,
            'slug' => $this->slug,
            'slug_en' => $this->slug_en,
            'url' => route('post.show', $this->slug_en),
            'description' => $this->description,
            'description_en' => $this->description_en,
            'status' => $this->status(),
            'volume' => new VolumeResource($this->volume),
            'issue' => new IssueResource($this->issue),
            'created_date' => $this->created_at->format('d-m-Y h:i a'),
            'author' => new UsersResource($this->user),
            'category' => new CategoriesResource($this->category), // in this case category as one  element
            'tags' => TagsResource::collection($this->tags), // in this case tags as multiple elements
            'media' => UsersPostsMediaResource::collection($this->media), // in this case media as multiple elements


        ];
    }
}
