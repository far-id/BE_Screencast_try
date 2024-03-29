<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Screencast\PlaylistResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            "id"=> $this->id,
            "user"=> new UserResource($this->user),
            "playlist"=> new PlaylistResource($this->playlist),
            "price"=> [
                'formatted' => number_format($this->price, 0, '.', '.'),
                'default' => $this->price
            ],
            "added_at"=> $this->created_at->format('d F, Y'),
        ];
    }
}
