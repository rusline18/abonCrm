<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'room';
    protected $dateFormat = 'U';
    protected $fillable = ['name', 'branch_id', 'user_id'];

    public function branch()
    {
        return $this->belongsTo('Growth\Branch');
    }
}
