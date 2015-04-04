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

class StaffSettingsController extends Controller {

    public function index()
    {
        return ScopedStaff::getWithData();
    }

    public function show($id)
    {
        return ScopedStaff::find($id);
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

    }

    public function destroy($id)
    {
        return ScopedStaff::destroy($id);
    }
}