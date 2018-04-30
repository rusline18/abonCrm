<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $table = 'direction';
    protected $dateFormat = 'U';
    protected $fillable = ['user_id', 'name'];

    public function executes()
    {
        return $this->belongsToMany('Growth\Execute', 'execute_direction');
    }

    public function shedule()
    {
        return $this->hasOne('Growth\Shedule');
    }
}
