<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/1/2015
 * Time: 2:24 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use Illuminate\Support\Str;
use Input;
use UnifySchool\Entities\School\ScopedCourse;
use UnifySchool\Entities\School\ScopedCourseCategory;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\CourseSettingsRequest;

class CourseSettingsController extends Controller {

    public static $action_add_course_category = "add_course_category";

    public function index()
    {
        $action = Input::get('action', 'default');

        switch ($action) {
            case static::$action_add_course_category:
                return ScopedCourseCategory::getWithData();
            case 'default':
                return ScopedCourse::getWithData();
        }

    }

    public function store(CourseSettingsRequest $request)
    {

        $action = Input::get('action', 'default');

        switch ($action) {
            case static::$action_add_course_category:
                return $this->addNewCourseCategory($request);
            case 'default':
                return $this->addNewCourse($request);
        }
    }

    public function show($id)
    {

    }

    public function update($id)
    {

    }

    public function destroy($id)
    {

    }

    private function addNewCourseCategory(CourseSettingsRequest $request)
    {
        $data = [
            'school_id'  => $this->getSchool()->id,
            'name' => $request->get('name'),
            'scoped_school_category_id' => $request->get('school_category_id')
        ];

       ScopedCourseCategory::create($data);

        return \Response::json(['all' => ScopedCourseCategory::getWithData()]);
    }

    private function addNewCourse(CourseSettingsRequest $request)
    {
        $data = [
            'school_id'  => $this->getSchool()->id,
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'scoped_course_category_id' => $request->get('course_category_id'),
            'slug' => Str::slug($request->get('name'))
        ];

        ScopedCourse::create($data);

        return \Response::json(['all' => ScopedCourse::getWithData()]);
    }
}