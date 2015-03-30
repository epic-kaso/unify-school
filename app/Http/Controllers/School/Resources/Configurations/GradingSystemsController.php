<?php namespace UnifySchool\Http\Controllers\School\Resources\Configurations;

use Illuminate\Support\Str;
use UnifySchool\Http\Requests;
use UnifySchool\Http\Controllers\Controller;

use UnifySchool\Http\Requests\GradingSystemsRequest;
use UnifySchool\Repositories\School\ScopedGradingSystemsRepository;

class GradingSystemsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param ScopedGradingSystemsRepository $repository
	 * @return Response
	 */
	public function index(ScopedGradingSystemsRepository $repository)
	{
		return $repository->all();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param GradingSystemsRequest $request
	 * @param ScopedGradingSystemsRepository $repository
	 * @return Response
	 */
	public function store(GradingSystemsRequest $request ,ScopedGradingSystemsRepository $repository)
	{
		$repository->create([
			'school_id' => $this->getSchool()->id,
			'name' => $request->get('name'),
			'slug' => Str::slug($request->get('name')),
			'grades' => $request->get('grades')
		]);

		return $repository->all();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 * @param ScopedGradingSystemsRepository $repository
	 * @return Response
	 */
	public function show($id,ScopedGradingSystemsRepository $repository)
	{
		return $repository->find($id);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param GradingSystemsRequest $request
	 * @param ScopedGradingSystemsRepository $repository
	 * @return Response
	 */
	public function update($id,GradingSystemsRequest $request,ScopedGradingSystemsRepository $repository)
	{
		$gradingSystem = $repository->find($id);

		$gradingSystem->name = $request->get('name');
		$gradingSystem->slug = Str::slug($gradingSystem->name);
		$gradingSystem->grades =  $request->get('grades');
		$gradingSystem->save();

		return $gradingSystem;

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @param ScopedGradingSystemsRepository $repository
	 * @return Response
	 */
	public function destroy($id,ScopedGradingSystemsRepository $repository)
	{
		return $repository->delete($id);
	}

}
