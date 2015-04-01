<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 4/1/2015
 * Time: 8:31 AM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use Illuminate\Support\Str;
use Input;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\CategoriesAndClassesRequest;
use UnifySchool\Repositories\School\ScopedSchoolCategoriesRepository;

class CategoryAndClassesSettingsController extends Controller {

    public static $action_school_category = 'school_category';
    public static $action_school_category_arms = 'school_category_arms';
    public static $action_school_category_arm_subarms = 'school_category_arm_subarms';

    public function index()
    {

    }

    public function show($id)
    {

    }

    public function store(CategoriesAndClassesRequest $request, ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
    {
        $action = $request->get('action','default');

        switch($action){
            case static::$action_school_category:
                return $this->createNewSchoolCategory($request,$schoolCategoriesRepository);
        }
    }

    public function update($id)
    {

    }

    public function destroy($id,ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
    {
        $action = Input::get('action','default');

        switch($action){
            case static::$action_school_category:
                $schoolCategoriesRepository->delete($id);
                return \Response::json(['success' => true]);
        }
    }

    private function createNewSchoolCategory(CategoriesAndClassesRequest $request, ScopedSchoolCategoriesRepository $schoolCategoriesRepository)
    {
        $data = [
            'scoped_school_type_id' => $request->get('school_type_id'),
            'school_id' => $this->getSchool()->id,
            'display_name' => $request->get('name'),
            'name' => Str::slug($request->get('name'))
            ];

        $model = $schoolCategoriesRepository->create($data);
        $model->load(['school_category_arms', 'school_category_arms.school_category_arm_subdivisions']);
        return \Response::json(['success' => true,'model' => $model]);
    }
}