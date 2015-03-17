<?php namespace UnifySchool\Http\Controllers\SuperAdmin\Resources;

use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests;
use UnifySchool\Http\Requests\CreateSchoolRequest;
use UnifySchool\School;

class SchoolController extends Controller
{
    protected $action_updateActiveState = 'updateActiveState';

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
    public function update($id)
    {
        $school = School::find($id);

        if (is_null($school))
            abort(404);

        $action = \Request::get('action');

        switch ($action) {
            case $this->action_updateActiveState:
                $school->setActivateState(\Request::get('active'));
                break;
        }

        return \Response::json(['response' => 'success']);
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
