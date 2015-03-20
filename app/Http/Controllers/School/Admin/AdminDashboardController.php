<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/14/2015
 * Time: 7:05 PM
 */

namespace UnifySchool\Http\Controllers\School\Admin;


use UnifySchool\Http\Controllers\Controller;
use UnifySchool\School;

class AdminDashboardController extends Controller
{


    function __construct()
    {
        $this->middleware('auth.school');
    }

    public function getIndex()
    {
        $school = $this->getSchool();
        $school->load(School::$relationData);

        return view('school.admin.dashboard.index', compact('school'));
    }

    public function getPartial($first, $second = null, $third = null)
    {
        if(!is_null($first) && is_null($second) && is_null($third)) {
            return view('school.admin.dashboard.partials.' . $first);
        }elseif(!is_null($first) && !is_null($second) && is_null($third)){
            return view("school.admin.dashboard.partials.$first.$second");
        }elseif(!is_null($first) && !is_null($second) && !is_null($third)){
            return view("school.admin.dashboard.partials.$first.$second.$third");
        }else{
            abort(404);
            return null;
        }
    }
}