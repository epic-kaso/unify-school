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
use UnifySchool\Services\Modules\Loader;

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

        $modules = Loader::loadSchoolModule($school);
        $assets = '';
        if(!is_null($modules)) {
            foreach ($modules as $module) {
                $assets .= Loader::prepareAssetsLink($module);
            }
        }

        return view('school.admin.dashboard.index', compact('school','assets','modules'));
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

    public function getLoadModule(){
        $argmuments = func_get_args();
        $ui_path = implode('.',$argmuments);
        return view("school.modules.$ui_path");
    }
}