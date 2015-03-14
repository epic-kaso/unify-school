<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/14/2015
 * Time: 7:05 PM
 */

namespace UnifySchool\Http\Controllers\Admin;


use UnifySchool\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{

    public function getIndex()
    {
        $school = $this->getSchool();
        return view('admin.dashboard.index', compact('school'));
    }
}