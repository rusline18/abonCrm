<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Shedule extends Model
{
    protected $table = 'shedule';
    protected $fillable = ['date', 'direction_id', 'type', 'user_id', 'branch_id', 'room_id'];
    
}
