<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/31/2015
 * Time: 2:37 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use UnifySchool\BehaviourCategory;
use UnifySchool\Entities\School\ScopedBehaviour;
use UnifySchool\Events\Academics\BehaviourAssessmentSystemAdded;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\BehaviourAssessmentRequest;

class BehaviourAssessmentSystemController extends Controller
{

    const ACTION_CATEGORIES = 'categories';

    public function index()
    {
        $action = \Input::get('action', 'default');

        switch ($action) {
            case 'default':
                return ScopedBehaviour::with('behaviour_category')->get();
            case self::ACTION_CATEGORIES:
                return BehaviourCategory::all();
        }
    }

    public function store(BehaviourAssessmentRequest $request)
    {
        $behaviour = new ScopedBehaviour();
        $behaviour->name = $request->get('name');
        $behaviour->behaviour_category_id = $request->get('behaviour_category_id');
        $behaviour->save();

        event(new BehaviourAssessmentSystemAdded());

        return \Response::json(['all' => ScopedBehaviour::with('behaviour_category')->get()]);
    }

    public function show($id)
    {
        return BehaviourCategory::find($id);
    }

    public function update($id, BehaviourAssessmentRequest $request)
    {

        return \Response::json(['all' => ScopedBehaviour::with('behaviour_category')->get()]);
    }

    public function destroy($id)
    {
        ScopedBehaviour::destroy($id);
        return \Response::json(['all' => ScopedBehaviour::with('behaviour_category')->get()]);
    }
}