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
use UnifySchool\Entities\School\ScopedSchoolCategory;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\CourseSettingsRequest;

class CourseSettingsController extends Controller
{

    public static $action_add_course_category = "add_course_category";
    public static $action_assign_course = "assign_course";

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
            default:
                return $this->addNewCourse($request);
        }
    }

    public function show($id)
    {

    }

    public function update($id, CourseSettingsRequest $request)
    {
        $action = Input::get('action', 'default');

        switch ($action) {
            case static::$action_assign_course:
                return $this->assignCourse($id, $request);
            case 'default':
                break;
        }
    }

    public function destroy($id)
    {

    }

    private function addNewCourseCategory(CourseSettingsRequest $request)
    {
        $data = [
            'school_id' => $this->getSchool()->id,
            'name' => $request->get('name'),
            'scoped_school_category_id' => $request->get('school_category_id')
        ];

        ScopedCourseCategory::create($data);

        return \Response::json(['all' => ScopedCourseCategory::getWithData()]);
    }

    private function addNewCourse(CourseSettingsRequest $request)
    {
        
        $bulk = $request->get('bulk',false);//courses
        
        if($bulk){
            
            $courses = $request->get('courses');//courses
            $data = [];
            
            foreach($courses as $course){
                $data[] = [
                    'school_id' => $this->getSchool()->id,
                    'name' => $course['name'],
                    'code' => $course['code'],
                    'scoped_course_category_id' => $course['course_category']['id'],
                    'slug' => Str::slug($course['name'])
                ];
            }
            
            $response = \DB::table(ScopedCourse::table())->insert($data);
            
        }else{
        
            $data = [
                'school_id' => $this->getSchool()->id,
                'name' => $request->get('name'),
                'code' => $request->get('code'),
                'scoped_course_category_id' => $request->get('course_category_id'),
                'slug' => Str::slug($request->get('name'))
            ];
    
            $response = ScopedCourse::create($data);
        }

        return \Response::json(['all' => ScopedCourse::getWithData(),'response' => $response]);
    }

    private function assignCourse($id, CourseSettingsRequest $request)
    {
        $schoolCategory = ScopedSchoolCategory::find($id);
        if (is_null($schoolCategory))
            abort(404, 'invalid school category');

        $assigned_courses = $request->get('assigned_courses');

        $schoolCategory->assigned_courses = $assigned_courses;
        $schoolCategory->save();

        return \Response::json(['model' => $schoolCategory]);
    }
}