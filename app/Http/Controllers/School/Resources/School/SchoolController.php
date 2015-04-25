<?php namespace UnifySchool\Http\Controllers\School\Resources\School;

use UnifySchool\Commands\School\CreateNewSchool;
use UnifySchool\Commands\School\UpdateSchoolAdminDetails;
use UnifySchool\Commands\School\UpdateSchoolCategories;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests;
use UnifySchool\Http\Requests\CreateSchoolRequest;
use UnifySchool\Repositories\SchoolRepository;
use UnifySchool\School;

class SchoolController extends Controller
{
    protected $action_school_categories_update = 'school_categories_update';
    protected $action_admin_login_details_update = 'admin_login_details_update';

    /**
     * Display a listing of the resource.
     *
     * @param SchoolRepository $schoolRepository
     * @return Response
     */
    public function index(SchoolRepository $schoolRepository)
    {
        return $schoolRepository->all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSchoolRequest $request
     * @return Response
     */
    public function store(CreateSchoolRequest $request)
    {
        $createSchool = new CreateNewSchool(
            $request->get('name'),
            $request->get('country'),
            $request->get('state'),
            $request->get('city'),
            $request->get('selected_school_type'),
            $request->get('school_types')
        );
        $school = $this->dispatch($createSchool);

        $school->load(School::$relationData);

        $this->setGlobalContext($school);

        $this->cleanUpCache();

        return $school;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param SchoolRepository $schoolRepository
     * @return Response
     */
    public function show($id,SchoolRepository $schoolRepository)
    {
        $school = $schoolRepository->find($id);
        return $school;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param CreateSchoolRequest $request
     * @param SchoolRepository $schoolRepository
     * @return Response
     */
    public function update($id, CreateSchoolRequest $request,SchoolRepository $schoolRepository)
    {
        $action = $request->get('action');

        switch ($action) {
            case $this->action_admin_login_details_update:
                $schoolRepository->updateAdminLoginDetails($request);
                break;
            case $this->action_school_categories_update:
                $schoolRepository->updateSchoolCategories($request);
                break;
        }

        $this->cleanUpCache();

        return School::withData()->find($request->get('id'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param SchoolRepository $schoolRepository
     * @return Response
     */
    public function destroy($id,SchoolRepository $schoolRepository)
    {
        $this->cleanUpCache();
        return $schoolRepository->delete($id);
    }

    private function cleanUpCache()
    {
        \Cache::flush();
    }

}
