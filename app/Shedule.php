<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Shedule extends Model
{
    protected $table = 'shedule';
    protected $fillable = ['date', 'start', 'end', 'direction_id', 'type', 'user_id', 'branch_id', 'room_id'];

    public function directions()
    {
        return $this->belongsTo('Growth\Direction', 'direction_id', 'id');
    }

    public function clients()
    {
        return $this->belongsToMany('Growth\Client', 'shedule_client');
    }
}
