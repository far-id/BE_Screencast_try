<?php

namespace App\Http\Resources\Screencast;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
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
            'instructor' => $this->user,
            'picture' => $this->picture,
            'name' => $this->name,
            'slug' => $this->slug,
            'tags' => TagsResource::collection($this->tags),
            'description' => $this->description,
            'price' => [
                'formatted' => number_format($this->price, 0, '.', '.'),
                'default' => $this->price
            ],
            'episodes' => $this->videos_count
        ];
    }
}
