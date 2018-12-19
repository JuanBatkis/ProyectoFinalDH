<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soft_gpu extends Model
{
    protected $table = 'soft_gpus';

    protected $fillable = [
        'gpu_brand',
        'v_ram',
        'openGl'
    ];
}
