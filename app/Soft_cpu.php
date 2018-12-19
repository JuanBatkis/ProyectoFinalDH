<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soft_cpu extends Model
{
    protected $table = 'soft_cpus';

    protected $fillable = [
        'cpu_brand',
        'bit',
        'multicore'
    ];
}
