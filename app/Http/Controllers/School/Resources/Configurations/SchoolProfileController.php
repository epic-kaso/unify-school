<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/2/2015
 * Time: 8:31 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use Carbon\Carbon;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\SchoolProfileSettingsRequest;
use UnifySchool\SchoolProfile;

class SchoolProfileController extends Controller {

    public function index()
    {
        return SchoolProfile::all();
    }


    public function show($id)
    {
        return SchoolProfile::find($id);
    }

    public function store(SchoolProfileSettingsRequest $request)
    {
        $school  = $this->getSchool();
        $schoolProfile = SchoolProfile::firstOrCreate(['school_id' => $school->id]);
        $schoolProfile->motto = $request->get('motto');
        $schoolProfile->mission = $request->get('mission');
        $schoolProfile->vision = $request->get('vision');
        $schoolProfile->about = $request->get('about');
        $schoolProfile->contact_email = $request->get('contact_email');
        $schoolProfile->contact_phone_number = $request->get('contact_phone_number');
        $schoolProfile->established_date = Carbon::parse($request->get('established_date'));

        $logoImage = $request->get('image',null);

        if(!is_null($logoImage) && isset($logoImage['dataURL'])) {
            $logo = \Image::make($logoImage['dataURL'])->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('data-url');

            $schoolProfile->logo = [ 'dataURL' => $logo->encoded ,'file' => ['type' => $logo->extension ]];
        }
        $schoolProfile->save();

        $school->name = $request->get('name');
        $school->save();

        return $schoolProfile;
    }

    public function destroy($id)
    {
        return SchoolProfile::destroy($id);
    }
}