<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/15/2015
 * Time: 5:25 PM
 */

namespace UnifySchool\Http\Controllers\SuperAdmin\Dashboard;


use UnifySchool\Http\Controllers\Controller;
use UnifySchool\School;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.unify');
    }

    public function getIndex()
    {
        $schools = School::all();
        return view('super-admin.dashboard.index', compact('schools'));
    }


    public function getPartial($partial)
    {
        return view('super-admin.dashboard.partials.' . $partial);
    }

}