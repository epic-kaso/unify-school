<?php namespace UnifySchool\Http\Controllers;

use UnifySchool\Http\Requests;

class LandingPageController extends Controller
{

    public function getIndex()
    {
        $school = $this->getSchool();

        return view('landing_page.index', ['school' => $school]);
    }

}
