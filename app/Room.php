<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'room';
    protected $fillable = ['name', 'branch_id'];
}
