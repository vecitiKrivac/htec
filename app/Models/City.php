<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name',
        'description'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function airports()
    {
        return $this->hasMany(Airport::class);
    }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class)->latest();
    // }
}
