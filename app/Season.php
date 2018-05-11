<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

/**
 * Абонимент
 * Class Season
 * @package Growth
 */
class Season extends Model
{
    protected $table = 'season';
    protected $dateFormat = 'U';
    protected $fillable = ['period', 'number', 'unlimited', 'active', 'sum', 'user_id'];
}
