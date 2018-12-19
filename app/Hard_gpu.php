<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hard_gpu extends Model
{
    protected $fillable = [
        'brand',
        'name',
        'v_ram',
        'openGl',
        'laptop',
        'release_date'
    ];
}
