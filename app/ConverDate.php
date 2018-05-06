<?php

namespace Growth;

use Illuminate\Database\Eloquent\Model;

class ConverDate extends Model
{
    /**
     * Конвертиртация дату в unix формат
     */
    public static function unixFormat($dateRequest)
    {
        $month = self::month(1);
        $date = preg_split('/ /', $dateRequest);
        $date[1] = array_search($date[1], $month);
        return strtotime($date[2].'-'.$date[1].'-'.$date[0]);
    }

    /**
     * Массив времени
     * @return array
     */
    public static function time()
    {
        return ['hour' => ['08','09','10','11','12','13','14','15','16','17','18','19','20','21'], 'minute' => ['00','30']];
    }

    public static function month(int $number)
    {
        return [$number => 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
    }

    public static function dateFormat(int $date)
    {
        $mount = self::month(0);
        $monthDate = (int)date('n', $date);
        $dateUnix = getdate($date);
        $dateUnix['mday'] = $dateUnix['mday'] < 10 ? '0'.$dateUnix['mday'] : $dateUnix['mday'];
        return $dateUnix['mday'].' '.$mount[$monthDate].' '.$dateUnix['year'];
    }
}
