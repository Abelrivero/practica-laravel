<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "dateBirth"
    ];

    public function movies(): HasMany
    {
        return $this->hasMany(Actor_Movie::class,'actor_id','id');
    }
    
}
