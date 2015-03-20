<?php namespace UnifySchool\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use UnifySchool\Entities\Context\SchoolContextTrait;
use UnifySchool\School;

abstract class Controller extends BaseController
{

    use DispatchesCommands, ValidatesRequests, SchoolContextTrait;

}
