<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liked_build extends Model
{
    protected $table = 'liked_builds';

    protected $fillable = [
        'user_id',
        'build_id',
    ];

    public function users()
    {
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function builds()
    {
        return $this->hasMany(Build::class, 'build_id', 'id');
    }
}
