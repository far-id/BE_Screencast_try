<?php

namespace App\Http\Resources\Screencast;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
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
            'playlist' => new PlaylistResource($this->playlist),
            'title' => $this->title,
            'slug' => $this->slug,
            'unique_video_id' => $this->unique_video_id,
            'episode' => $this->episode,
            'runtime' => $this->runtime,
            'intro' => $this->intro,
            'published' => $this->created_at->format('d F, Y'),
        ];
    }
}
