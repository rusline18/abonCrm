<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Execute extends Model
{
    protected $table = 'execute';
    protected $dateFormat = 'U';
    protected $fillable = [
        'last_name', 'name', 'phone', 'email', 'user_id'
    ];

    public function directions()
    {
        return $this->belongsToMany('Growth\Direction', 'execute_direction');
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->name}";
    }
}
