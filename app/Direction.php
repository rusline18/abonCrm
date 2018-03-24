<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $table = 'direction';
    protected $fillable = ['id_user', 'name'];

    public function executes()
    {
        return $this->belongsToMany('Growth\Execute', 'execute_direction');
    }
}
