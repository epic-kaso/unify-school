<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/28/2015
 * Time: 9:49 AM
 */

namespace UnifySchool\Handlers\Events;


use Log;
use UnifySchool\Entities\Context\SchoolContextTrait;

class SchoolLoginEventHandler {
//auth.login

    use SchoolContextTrait;

    public function handle($event)
    {
        Log::debug(static::class . ' Called Successfully');

        $school = $this->getSchool();
        $school->first_login = false;
        $school->save();

        return true;
    }
}