<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\General\CategoriesResource;
use App\Http\Resources\General\PostCommentsResource;
use App\Http\Resources\General\UsersPostsMediaResource;
use App\Http\Resources\General\TagsResource;
use App\Http\Resources\General\UsersResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersPostsResource extends JsonResource
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
            'status' => $this->status,
            'status_text' => $this->status(),
            'comment_able' => $this->comment_able,
            'comments_count' => $this->comments->where('status', 1)->count(),
            'created_date' => $this->created_at->format('d-m-Y h:i a'),
        ];
    }
}
