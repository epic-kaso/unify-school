<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/19/2015
 * Time: 4:27 PM
 */

namespace UnifySchool\Entities\Context;


use UnifySchool\School;

trait SchoolContextTrait {


    public function getSchool()
    {
        $context = \App::make('UnifySchool\Entities\Context\ContextInterface');
        return $context->get();
    }

    protected function setGlobalContext(School $school)
    {
        $context = \App::make('UnifySchool\Entities\Context\ContextInterface');
        $context->set($school);
    }

    protected function productionEnvironment(){
        return env('APP_ENV','local') != 'local';
    }
}