<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $dateFormat = 'U';
    protected $fillable = ['last_name', 'name', 'phone', 'email', 'gender', 'user_id'];

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->name}";
    }
}
