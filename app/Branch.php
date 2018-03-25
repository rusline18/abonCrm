<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';
    protected $fillable = ['name', 'city', 'street', 'build', 'appartament', 'phone', 'user_id'];

    public function rooms()
    {
        return $this->hasMany('Growth\Room');
    }
}
