<?php namespace UnifySchool\Http\Controllers;

use Cache;
use UnifySchool\Http\Requests;

class LandingPageController extends Controller
{

    public function getIndex()
    {
        $school = $this->getSchool();

        return view('landing_page.index', ['school' => $school]);
    }

    public function getFlushCache(){
        Cache::flush();
        return 'Done';
    }

}
