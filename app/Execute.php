<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Execute extends Model
{
    protected $table = 'execute';
    protected $fillable = [
        'last_name', 'name', 'phone', 'email', 'id_user'
    ];

    public function directions()
    {
        return $this->belongsToMany('Growth\Direction', 'execute_direction');
    }
}
