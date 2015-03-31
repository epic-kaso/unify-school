<?php namespace UnifySchool\Http\Controllers\School\Resources\Configurations;

use Input;
use UnifySchool\Http\Requests;
use UnifySchool\Http\Controllers\Controller;

use Illuminate\Http\Request;
use UnifySchool\Http\Requests\GradeAssessmentSystemsRequest;
use UnifySchool\Repositories\School\ScopedGradeAssessmentSystemsRepository;
use UnifySchool\Repositories\School\ScopedSchoolCategoriesRepository;

class GradeAssessmentSystemsController extends Controller {

	protected static $action_assign_grade_assessment_system = 'assignGradeAssessmentSystem';

	/**
	 * Display a listing of the resource.
	 *
	 * @param ScopedGradeAssessmentSystemsRepository $repository
	 * @param ScopedSchoolCategoriesRepository $schoolCategoriesRepository
	 * @return Response
	 */
	public function index(ScopedGradeAssessmentSystemsRepository $repository,ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
	{
		$action = Input::get('action','default');

		switch($action){
			case 'default':
				return $repository->all();

			case static::$action_assign_grade_assessment_system:
				return \Response::json($schoolCategoriesRepository->getAssignedGradeAssessmentSystem());
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param GradeAssessmentSystemsRequest $request
	 * @param ScopedGradeAssessmentSystemsRepository $repository
	 * @param ScopedSchoolCategoriesRepository $schoolCategoriesRepository
	 * @return Response
	 */
	public function store(GradeAssessmentSystemsRequest $request,
						  ScopedGradeAssessmentSystemsRepository $repository,
							ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
	{
		$action = $request->get('action','default');

		switch($action) {
			case 'default':
				return $this->createGradeAssessmentSystem($request, $repository);

			case static::$action_assign_grade_assessment_system:
				return $this->assignGradeAssessmentSystem($request, $schoolCategoriesRepository);
		}
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
				$gradeAssessmentSystem->divisions = $request->get('divisions');
				$gradeAssessmentSystem->total_score = $request->get('total_score');
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

	/**
	 * @param GradeAssessmentSystemsRequest $request
	 * @param ScopedSchoolCategoriesRepository $schoolCategoriesRepository
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	private function assignGradeAssessmentSystem(GradeAssessmentSystemsRequest $request, ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
	{
		$data = $request->input();
		foreach ($data as $key => $value) {
			$category = $schoolCategoriesRepository->findBy('name', $key);
			if (!is_null($category)) {
				$category->scoped_grade_assessment_system_id = $value;
				$category->save();
			}
		}
		return \Response::json(['success' => true]);
	}

	/**
	 * @param GradeAssessmentSystemsRequest $request
	 * @param ScopedGradeAssessmentSystemsRepository $repository
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	private function createGradeAssessmentSystem(GradeAssessmentSystemsRequest $request, ScopedGradeAssessmentSystemsRepository $repository)
	{
		$repository->create([
			'school_id' => $this->getSchool()->id,
			'name' => $request->get('name'),
			'total_score' => $request->get('total_score'),
			'divisions' => $request->get('divisions')
		]);
		return \Response::json(['all' => $repository->all(), 'success' => true]);
	}

}
