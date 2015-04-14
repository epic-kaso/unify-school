<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/14/2015
 * Time: 11:05 AM
 */

namespace UnifySchool\Http\Controllers\School\Modules\Admin\Students;


use UnifySchool\Entities\School\ScopedStudent;
use UnifySchool\Http\Controllers\Controller;

class StudentsController extends Controller {

    public function index()
    {
        return ScopedStudent::all();
    }

    public function show($id)
    {
        return ScopedStudent::find($id);
    }

    public function store()
    {
        return \Input::all();
    }

    public function update($id)
    {

    }

    public function destroy($id)
    {
        return ScopedStudent::destroy($id);
    }
}