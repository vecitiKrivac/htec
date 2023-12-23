<?php

namespace App\Http\Resources\Airport;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AirportResource extends JsonResource
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
            'city' => $this->city->name,
            'name' => $this->name,
            'iata' => $this->iata,
            'icao' => $this->icao,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'time_zone_utc' => $this->time_zone_utc,
            'dst' => $this->dst,
            'time_zone_type' => $this->time_zone_type,
            'source' => $this->source
        ];
    }
}
