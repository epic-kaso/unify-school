<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/25/2015
 * Time: 12:36 PM
 */

namespace UnifySchool\Handlers\Events;


use Log;
use UnifySchool\Entities\Context\SchoolContextTrait;
use UnifySchool\School;
use UnifySchool\Services\SchoolSetupInfo;

class SchoolConfigStatusHandler {

    use SchoolContextTrait;
    /**
     * @var SchoolSetupInfo
     */
    private $schoolSetupInfo;

    /**
     * @var School
     */
    private $school;


    /**
     * @param SchoolSetupInfo $schoolSetupInfo
     */
    function __construct(SchoolSetupInfo $schoolSetupInfo)
    {

        $this->schoolSetupInfo = $schoolSetupInfo;
        $this->school = $this->getSchool();
    }

    public function handle($event)
    {
        Log::debug(static::class . ' Called Successfully');
        $this->school->setup_complete = $this->schoolSetupInfo->isSetupComplete($this->school);
        $this->school->save();
        return true;
    }
}