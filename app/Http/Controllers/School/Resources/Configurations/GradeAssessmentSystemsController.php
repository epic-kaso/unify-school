<?php namespace UnifySchool\Http\Controllers\School\Resources\Configurations;

use UnifySchool\Http\Requests;
use UnifySchool\Http\Controllers\Controller;

use Illuminate\Http\Request;
use UnifySchool\Http\Requests\GradeAssessmentSystemsRequest;
use UnifySchool\Repositories\School\ScopedGradeAssessmentSystemsRepository;

class GradeAssessmentSystemsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param ScopedGradeAssessmentSystemsRepository $repository
	 * @return Response
	 */
	public function index(ScopedGradeAssessmentSystemsRepository $repository)
	{
		return $repository->all();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param GradeAssessmentSystemsRequest $request
	 * @param ScopedGradeAssessmentSystemsRepository $repository
	 * @return Response
	 */
	public function store(GradeAssessmentSystemsRequest $request,ScopedGradeAssessmentSystemsRepository $repository)
	{
		$repository->create([
			'school_id' => $this->getSchool()->id,
			'name' => $request->get('name'),
			'total_score' => $request->get('total_score'),
			'divisions' => $request->get('divisions')
		]);

		return \Response::json(['all' => $repository->all(),'success' => true]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @param ScopedGradeAssessmentSystemsRepository $repository
	 * @return Response
	 */
	public function show($id,ScopedGradeAssessmentSystemsRepository $repository)
	{
		return $repository->find($id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param GradeAssessmentSystemsRequest $request
	 * @param ScopedGradeAssessmentSystemsRepository $repository
	 * @return Response
	 */
	public function update($id,GradeAssessmentSystemsRequest $request,ScopedGradeAssessmentSystemsRepository $repository)
	{
		$gradeAssessmentSystem = $repository->find($id);

		$gradeAssessmentSystem->name = $request->get('name');
		$gradeAssessmentSystem->divisions =  $request->get('divisions');
		$gradeAssessmentSystem->total_score =  $request->get('total_score');
		$gradeAssessmentSystem->save();

		return $gradeAssessmentSystem;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,ScopedGradeAssessmentSystemsRepository $repository)
	{
		return $repository->delete($id);
	}

}
