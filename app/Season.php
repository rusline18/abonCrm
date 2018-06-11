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
    const
        ACTIVE = 1,
        NOT_ACTIVE = 0,
        UNLIMIT = 1,
        LIMIT = 0;

    protected $table = 'season';
    protected $dateFormat = 'U';
    protected $fillable = ['period', 'number', 'unlimited', 'active', 'sum', 'user_id'];

    public function getSeasonFullname()
    {
        $period = __('season.period.'.$this->period);
        $unlimited = $this->unlimited == 1 ? 'Безлимит;' : '';
        return "Срок: {$period} {$unlimited} Кол-во занятий: {$this->number} Суммма: {$this->sum} руб.";
    }
}
