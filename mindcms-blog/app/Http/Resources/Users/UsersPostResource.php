<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersPostResource extends JsonResource
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
            'description' => $this->description,
            'description_en' => $this->description_en,
            'status' => $this->status,
            'status_text' => $this->status(),
            'comment_able' => $this->comment_able,
            'comments_count' => $this->comments->count(),
            'comments' => UsersPostCommentsResource::collection($this->comments),
            'category' => new UsersCategoriesResource($this->category), // in this case category as one  element
            'tags' => UsersTagsResource::collection($this->tags), // in this case tags as multiple elements
            'media' => UsersPostsMediaResource::collection($this->media), // in this case media as multiple elements
            'created_at' => $this->created_at->format('d-m-Y h:i a'),
        ];
    }
}
