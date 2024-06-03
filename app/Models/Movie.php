<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'year',
        'duration',
        'synopsis'
    ];

    public function actores(): HasMany
    {
        return $this->hasMany(Actor_Movie::class, 'movie_id', 'id');
    }
}
