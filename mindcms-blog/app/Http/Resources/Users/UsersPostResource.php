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
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'status_text' => $this->status(),
            'comment_able' => $this->comment_able,
            'comments_count' => $this->comments->count(),
            'comments' => UsersPostCommentsResource::collection($this->comments),
            'category' => new UsersCategoriesResource($this->category), // in this case category as one  element
            'tags' => UsersTagsResource::collection($this->tags), // in this case tags as multiple elements
            'media' => UsersPostsMediaResource::collection($this->media), // in this case media as multiple elements
        ];
    }
}
