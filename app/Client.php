<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';

    protected $fillable = ['last_name', 'name', 'phone', 'email', 'gender', 'id_user'];
}
