<?php namespace UnifySchool\Http\Controllers\School\Resources\School;

use UnifySchool\Commands\School\CreateNewSchool;
use UnifySchool\Commands\School\UpdateSchoolAdminDetails;
use UnifySchool\Commands\School\UpdateSchoolCategories;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests;
use UnifySchool\Http\Requests\CreateSchoolRequest;
use UnifySchool\School;

class SchoolController extends Controller
{
    protected $action_school_categories_update = 'school_categories_update';
    protected $action_admin_login_details_update = 'admin_login_details_update';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return School::withData()->get();
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

        $this->setGlobalContext($school);

        $school->load(School::$relationData);
        return $school;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return School::withData()->find($id);
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
     * @param CreateSchoolRequest $request
     * @return Response
     */
    public function update($id, CreateSchoolRequest $request)
    {
        $action = $request->get('action');

        switch ($action) {
            case $this->action_admin_login_details_update:
                $this->updateAdminLoginDetails($request);
                break;
            case $this->action_school_categories_update:
                $this->updateSchoolCategories($request);
                break;
        }

        return School::withData()->find($request->get('id'));
    }

    private function updateAdminLoginDetails($request)
    {
        $admin_email = $request->get('admin_email');
        $admin_password = $request->get('admin_password');

        $updateAdminDetailsCmd = new UpdateSchoolAdminDetails($admin_email, $admin_password, $this->getSchool());
        $this->dispatch($updateAdminDetailsCmd);
    }

    private function updateSchoolCategories($request)
    {
        $school_type = $request->get('school_type');

        if (isset($school_type['school_categories'])) {
            $updateSchoolCategoriesCommand =
                new UpdateSchoolCategories($school_type['school_categories'], $this->getSchool());
            $this->dispatch($updateSchoolCategoriesCommand);
        }
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
