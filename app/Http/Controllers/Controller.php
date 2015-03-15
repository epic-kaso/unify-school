<?php namespace UnifySchool\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use UnifySchool\School;

abstract class Controller extends BaseController
{

    use DispatchesCommands, ValidatesRequests;

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

}
