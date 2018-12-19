<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hard_cpu extends Model
{
    protected $fillable = [
        'brand',
        'name',
        'bit_32',
        'bit_64',
        'n_cores',
        'laptop',
        'release_date'
    ];
}
