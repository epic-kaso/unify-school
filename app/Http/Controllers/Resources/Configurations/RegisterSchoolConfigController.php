<?php namespace UnifySchool\Http\Controllers\Resources\Configurations;

use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests;
use UnifySchool\Repositories\SchoolTypeRepository;

class RegisterSchoolConfigController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param SchoolTypeRepository $schoolRepository
     * @return Response
     */
    public function index(SchoolTypeRepository $schoolRepository)
    {
        $config = new \stdClass();

        $school = new \stdClass();
        $school->selected_school_type = "";
        $school->name = "";
        $school->admin_email = "";
        $school->admin_password = "";
        $school->admin_password_confirmation = "";
        $school->school_types = $schoolRepository->fetchDefaultSchoolConfig();

        $config->school = $school;
        $config->countries = $schoolRepository->fetchSupportedCountries();

        return \Response::json($config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
