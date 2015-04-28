<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/28/2015
 * Time: 10:00 AM
 */

namespace UnifySchool\Handlers\Events;


use Log;
use UnifySchool\Entities\Context\SchoolContextTrait;
use UnifySchool\Events\NewSchoolRegistered;
use UnifySchool\Repositories\ModulesRepository;
use UnifySchool\School;

class ActivateBasicModules {

    use SchoolContextTrait;

    public function handle(NewSchoolRegistered $event, ModulesRepository $modulesRepository)
    {
        Log::debug(static::class . ' Called Successfully');

        $school = $event->getSchool();
        $school->modules = $modulesRepository->getBasicModules();
        $school->save();

        return true;
    }
}