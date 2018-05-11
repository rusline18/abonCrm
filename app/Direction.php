<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    protected $table = 'direction';
    protected $dateFormat = 'U';
    protected $fillable = ['user_id', 'name'];

    public function shedule()
    {
        return $this->hasOne('Growth\Shedule');
    }
}
