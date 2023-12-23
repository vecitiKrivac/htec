<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\City\CityResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'city' => new CityResource($this->city),
            'comment' => $this->comment,
            'created_at' => $this->created_at
        ];
    }
}
