<?php

namespace App\Http\Resources\City;

use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitySearchResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'country' => new CountryResource($this->whenLoaded('country')),
            'comments' => CommentResource::collection($this->whenLoaded('comments'))
        ];
    }
}
