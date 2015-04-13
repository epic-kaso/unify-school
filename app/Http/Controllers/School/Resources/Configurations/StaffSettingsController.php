<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/4/2015
 * Time: 1:49 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use UnifySchool\Entities\School\ScopedStaff;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\StaffSettingsRequest;
use UnifySchool\Repositories\School\ScopedStaffRepository;

class StaffSettingsController extends Controller {

    const ACTION_ASSIGN_COURSE = "action_assign_course";
    const ACTION_ASSIGN_CLASS = "action_assign_class";

    public function index(ScopedStaffRepository $repository)
    {
        return $repository->loadAll();
    }

    public function show($id)
    {
        $item = ScopedStaff::findOrFail($id);
        $item->loadAssignedCourses();
        $item->loadAssignedClasses();
        return $item;
    }

    public function store(StaffSettingsRequest $request)
    {
        $school  = $this->getSchool();

        $staff = new ScopedStaff;

        $staff->school_id       = $school->id;
        $staff->last_name       = $request->get('last_name');
        $staff->first_name      = $request->get('first_name');
        $staff->middle_name     = $request->get('middle_name');
        $staff->sex             = $request->get('sex');
        $staff->birth_date      = $request->get('birth_date');
        $staff->lga             = $request->get('lga');
        $staff->country         = $request->get('country');
        $staff->state           = $request->get('state');
        $staff->disabilities    = $request->get('disabilities',[]);
        $staff->qualifications  = $request->get('qualifications',[]);

        $staff->blood_group     = $request->get('blood_group');
        $staff->genotype        = $request->get('genotype');
        $staff->contact_address = $request->get('contact_address');
        $staff->contact_email   = $request->get('contact_email');
        $staff->contact_phone   = $request->get('contact_phone');
        $staff->employment_date = $request->get('employment_date');
        $staff->status          = $request->get('employment_status');
        $staff->religion        = $request->get('religion');


        $logoImage = $request->get('picture',null);
        if(!is_null($logoImage) && isset($logoImage['dataURL'])) {
            $logo = \Image::make($logoImage['dataURL'])->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('data-url');

            $staff->picture = [ 'dataURL' => $logo->encoded ,'file' => ['type' => $logo->mime ]];
        }

        $staff->save();

        return $staff;
    }

    public function update($id,StaffSettingsRequest $request)
    {
        $item = ScopedStaff::findOrFail($id);
        $action = $request->get('action','default');

        switch($action){
            case static::ACTION_ASSIGN_CLASS:
                return $this->assignClass($item,$request);
            case static::ACTION_ASSIGN_COURSE:
                return $this->assignCourse($item,$request);
            default:

        }
    }

    public function destroy($id)
    {
        return ScopedStaff::destroy($id);
    }

    private function assignClass(ScopedStaff $item,StaffSettingsRequest $request)
    {
        $class_ids = $request->get('assigned_classes',[]);
        $input = [];
        foreach($class_ids as $value){
            $input[] = $value['id'];
        }
        $item->assigned_classes = $input;
        $item->save();
        return $item;
    }

    private function assignCourse(ScopedStaff $item,StaffSettingsRequest $request)
    {
        $course_ids = $request->get('assigned_courses',[]);
        $input = [];
        foreach($course_ids as $value){
            $input[] = $value['id'];
        }
        $item->assigned_courses = $input;
        $item->save();
        return $item;
    }
}