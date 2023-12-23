<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'city_id',
        'name',
        'iata',
        'icao',
        'latitude',
        'longitude',
        'time_zone_utc',
        'dst',
        'time_zone_type',
        'source'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // public function sourceRoutes()
    // {
    //     return $this->hasMany(Route::class, 'source_airport_id');
    // }

    // public function destinationRoutes()
    // {
    //     return $this->hasMany(Route::class, 'destination_airport_id');
    // }
}
