<?php

namespace App\Http\Resources\City;

use App\Http\Resources\Country\CountryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'country' => new CountryResource($this->country),
            'name' => $this->name,
            'description' => $this->description

        ];
    }
}
