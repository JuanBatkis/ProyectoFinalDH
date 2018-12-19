<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = 'requirements';

    protected $fillable = [
        'ram',
        'soft_cpu_id',
        'soft_gpu_id',
        'disk'
    ];

    public function soft_cpus()
    {
        return $this->hasOne('App\Soft_cpu','id', 'soft_cpu_id');
    }

    public function soft_gpus()
    {
        return $this->hasOne('App\Soft_gpu','id', 'soft_gpu_id');
    }
}
