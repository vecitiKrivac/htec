<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'airline',
        'source_airport_id',
        'destination_airport_id',
        'codeshare',
        'stops',
        'equipment',
        'price'
    ];

    public function sourceAirport()
    {
        return $this->belongsTo(Airport::class, 'source_airport_id');
    }

    public function destinationAirport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }
}
