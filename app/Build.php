<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    protected $table = 'builds';

    protected $fillable = [
        'build_name',
        'user_id',
        'op_system',
        'softwares',
        'ram',
        'cpu_brand',
        'bit',
        'multicore',
        'gpu_brand',
        'v_ram',
        'openGl',
        'disk',
        'is_public',
        'likes',
    ];

    public function users()
    {
        return $this->hasOne('App\User','id', 'user_id');
    }

    public function liked_builds()
    {
        return $this->belongsTo(Liked_build::class, 'build_id', 'id');
    }
}

