<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $attributes = [
        'id',
        'name'
    ];

    protected $fillable = [
        'name'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
