<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Shedule extends Model
{
    protected $table = 'shedule';
    protected $dateFormat = 'U';
    protected $fillable = ['date', 'start', 'end', 'direction_id', 'execute_id','type', 'user_id', 'room_id', 'time_start', 'time_end'];

    public function directions()
    {
        return $this->belongsTo('Growth\Direction', 'direction_id', 'id');
    }

    public function clients()
    {
        return $this->belongsToMany('Growth\Client', 'shedule_client');
    }

    public function executes()
    {
        return $this->belongsTo('Growth\Execute', 'execute_id', 'id');
    }

    public function getTypeNameAttribute()
    {
        return $this->type == 1 ? 'Групповое занятие' : 'Индивидульные занятие';
    }
}
