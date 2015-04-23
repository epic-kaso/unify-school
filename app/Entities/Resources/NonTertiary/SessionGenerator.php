<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/21/2015
 * Time: 8:48 AM
 */

namespace UnifySchool\Entities\Resources\NonTertiary;


use Carbon\Carbon;

class SessionGenerator
{

    protected $newSessionEndMonth;
    const SEPTEMBER = 9;
    const AUGUST = 8;

    /**
     * SessionGenerator constructor.
     * @param $newSessionStartMonth
     * @param $newSessionEndMonth
     */
    public function __construct(Carbon $newSessionEndMonth = null)
    {

        if (!is_null($newSessionEndMonth))
            $this->newSessionEndMonth = $newSessionEndMonth;
        else
            $this->newSessionEndMonth = Carbon::create(null, static::AUGUST);
    }


    public function generatePastSession($count = 1)
    {
        return $this->generateSessions($count, 'subYear');
    }

    public function generateFutureSession($count = 1)
    {
        return $this->generateSessions($count, 'addYear');
    }

    public function generateCurrentSession()
    {
        return $this->generateSession(Carbon::now());
    }

    private function generateSessions($count, $action = 'subYear')
    {
        if (!is_numeric($count)) {
            return null;
        }

        if ($count == 1) {
            $year = Carbon::now()->{$action}();
            return $this->generateSession($year);
        }

        $response = [];

        if ($count > 1) {
            $year = Carbon::now()->{$action}();

            for ($i = 0; $i < $count; $i++) {
                $response[] = $this->generateSession($year);
                $year->{$action}();
            }

            return $response;
        }
    }

    private function generateSession(Carbon $date)
    {
        $currentYear = $date;
        $lastYear = Carbon::parse($date->toDayDateTimeString())->subYear();
        $nextYear = Carbon::parse($date->toDayDateTimeString())->addYear();

        if ($currentYear->month <= $this->newSessionEndMonth->month) {
            return "{$lastYear->year}/{$currentYear->year}";
        }

        return "{$currentYear->year}/{$nextYear->year}";
    }
}