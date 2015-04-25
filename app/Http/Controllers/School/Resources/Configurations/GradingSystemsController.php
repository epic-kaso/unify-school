<?php namespace UnifySchool\Http\Controllers\School\Resources\Configurations;

use Illuminate\Support\Str;
use Input;
use UnifySchool\Events\Academics\GradingSystemAdded;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests;
use UnifySchool\Http\Requests\GradingSystemsRequest;
use UnifySchool\Repositories\School\ScopedGradingSystemsRepository;
use UnifySchool\Repositories\School\ScopedSchoolCategoriesRepository;

class GradingSystemsController extends Controller
{

    protected static $action_assign_grading_system = 'assignGradingSystem';

    /**
     * Display a listing of the resource.
     *
     * @param ScopedGradingSystemsRepository $repository
     * @param ScopedSchoolCategoriesRepository $schoolCategoriesRepository
     * @return Response
     */
    public function index(ScopedGradingSystemsRepository $repository, ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
    {
        $action = Input::get('action', 'default');

        switch ($action) {
            case 'default':
                return $repository->all();

            case static::$action_assign_grading_system:
                return \Response::json($schoolCategoriesRepository->getAssignedGradingSystem());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GradingSystemsRequest $request
     * @param ScopedGradingSystemsRepository $repository
     * @param ScopedSchoolCategoriesRepository $schoolCategoriesRepository
     * @return Response
     */
    public function store(GradingSystemsRequest $request, ScopedGradingSystemsRepository $repository, ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
    {
        $action = $request->get('action', 'default');

        switch ($action) {
            case 'default':
                return $this->createGradingSystem($request, $repository);

            case static::$action_assign_grading_system:
                return $this->assignGradeAssessmentSystem($request, $schoolCategoriesRepository);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param ScopedGradingSystemsRepository $repository
     * @return Response
     */
    public function show($id, ScopedGradingSystemsRepository $repository)
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
    public function update($id, GradingSystemsRequest $request, ScopedGradingSystemsRepository $repository)
    {

        $gradingSystem = $repository->find($id);
        $gradingSystem->name = $request->get('name');
        $gradingSystem->slug = Str::slug($gradingSystem->name);
        $gradingSystem->grades = $request->get('grades');
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
    public function destroy($id, ScopedGradingSystemsRepository $repository)
    {
        return $repository->delete($id);
    }


    /**
     * @param GradingSystemsRequest $request
     * @param ScopedSchoolCategoriesRepository $schoolCategoriesRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function assignGradeAssessmentSystem(GradingSystemsRequest $request,
                                                 ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
    {
        $data = $request->input();
        foreach ($data as $key => $value) {
            $category = $schoolCategoriesRepository->findBy('name', $key);
            if (!is_null($category)) {
                $category->scoped_grading_system_id = $value;
                $category->save();
            }
        }
        return \Response::json(['success' => true]);
    }

    /**
     * @param GradingSystemsRequest $request
     * @param ScopedGradingSystemsRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function createGradingSystem(GradingSystemsRequest $request, ScopedGradingSystemsRepository $repository)
    {
        $repository->create([
            'school_id' => $this->getSchool()->id,
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'grades' => $request->get('grades')
        ]);

        event(new GradingSystemAdded());

        return \Response::json(['all' => $repository->all(), 'success' => true]);
    }
}
