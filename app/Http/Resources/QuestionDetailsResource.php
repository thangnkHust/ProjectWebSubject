<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'votes_count' => $this->votes_count,
            'answers_count' => $this->answers_count,
            'is_favorited'    => $this->is_favorited,
            'favorites_count' => $this->favorites_count,
            'views' => $this->views,
            'status' => $this->status,
            'body' => $this->body,
            'created_date' => $this->created_date,
            'user' => new UserResource($this->user),
        ];
    }
}
