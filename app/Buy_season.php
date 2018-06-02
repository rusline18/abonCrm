<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Buy_season extends Model
{
    protected $table = 'buy_season';
    protected $dateFormat = 'U';
    protected $fillable = ['season_id', 'client_id', 'user_id'];

    public function season()
    {
        return $this->hasOne('Growth\Season');
    }

    public function  client()
    {
        return $this->hasOne('Growth\Client');
    }
}
