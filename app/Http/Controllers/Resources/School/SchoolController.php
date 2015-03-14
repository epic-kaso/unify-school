<?php namespace UnifySchool\Http\Controllers\Resources\School;

use UnifySchool\Commands\CreateNewSchool;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests;
use UnifySchool\Http\Requests\CreateSchoolRequest;
use UnifySchool\School;

class SchoolController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return School::all();
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
            $request->get('selected_school_type')
        );
        $school = $this->dispatch($createSchool);

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
