<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'softwares';

    protected $fillable = [
        'name',
    ];

    public function op_systems()
    {
        return $this->hasMany(Op_system::class, 'software_id', 'id');
    }

    /*public function op_systems() {
        return $this->hasMany('App\Op_system', 'software_id');
    }

    public function op_systems() {
        return $this->hasMany(Op_system::class, 'software_id');
    }*/
}
