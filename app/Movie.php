<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function actors(){
        return $this->belongsToMany(Actor::class);
    }

    public function genres(){
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    protected $fillable = [
        'title',
        'rating',
        'awards',
        'length',
        'release_date',
        'genre_id'
    ];
}
