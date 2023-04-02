<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title' , 'desc' , 'img'
    ];

    public function cats(): BelongsToMany{
        return $this->belongsToMany(Cat::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
