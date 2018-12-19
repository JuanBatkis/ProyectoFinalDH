<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Op_system extends Model
{
    protected $table = 'op_systems';

    protected $fillable = [
        'software_id',
        'os_name',
        'req_id'
    ];

    public function softwares()
    {
        return $this->belongsTo(Software::class, 'software_id', 'id');
    }

    public function requirements()
    {
        return $this->hasOne('App\Requirement', 'id', 'req_id');
    }
}
