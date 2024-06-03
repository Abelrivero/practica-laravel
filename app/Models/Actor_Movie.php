<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Actor_Movie extends Model
{
    use HasFactory;

    protected $table = 'actor_movie';

    protected $fillable = [
        'actor_id',
        'movie_id'
    ];

    public function cast(): BelongsTo
    {
        return $this->belongsTo(Actor::class,'actor_id', 'id');
    }

    public function peliculasActor(): BelongsTo
    {
        return $this->belongsTo(Movie::class, 'movie_id', 'id');
    }

}
