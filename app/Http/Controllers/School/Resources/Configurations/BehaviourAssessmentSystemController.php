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
use UnifySchool\Entities\School\ScopedBehaviourSkillSystem;
use UnifySchool\Events\Academics\BehaviourAssessmentSystemAdded;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\BehaviourAssessmentRequest;

class BehaviourAssessmentSystemController extends Controller
{

    const ACTION_CATEGORIES = 'categories';

    public function index($BehaviourSkillSystemId)
    {
        $action = \Input::get('action', 'default');

        switch ($action) {
            case 'default':
                return ScopedBehaviour::with('behaviour_category')
                    ->whereScopedBehaviourSkillSystemId($BehaviourSkillSystemId)
                    ->get();
            case self::ACTION_CATEGORIES:
                return BehaviourCategory::all();
        }
    }

    public function store($BehaviourSkillSystemId,BehaviourAssessmentRequest $request)
    {
        $BehaviourSkillSystem = ScopedBehaviourSkillSystem::findOrFail($BehaviourSkillSystemId);

        $behaviour = new ScopedBehaviour();
        $behaviour->name = $request->get('name');
        $behaviour->behaviour_category_id = $request->get('behaviour_category_id');

        $BehaviourSkillSystem->behaviours()->save($behaviour);

        event(new BehaviourAssessmentSystemAdded());

        return \Response::json(['all' => ScopedBehaviour::with('behaviour_category')->get()]);
    }

    public function show($BehaviourSkillSystemId,$behaviourId)
    {
        return ScopedBehaviour::with('behaviour_category')
            ->whereId($behaviourId)
            ->whereScopedBehaviourSkillSystemId($BehaviourSkillSystemId)
            ->first();
    }

    public function update($BehaviourSkillSystemId,$behaviourId, BehaviourAssessmentRequest $request)
    {
        $item = ScopedBehaviour::with('behaviour_category')
            ->whereId($behaviourId)
            ->whereScopedBehaviourSkillSystemId($BehaviourSkillSystemId)
            ->first();

        return \Response::json(['all' => ScopedBehaviour::with('behaviour_category')->get()]);
    }

    public function destroy($BehaviourSkillSystemId,$behaviourId)
    {
        ScopedBehaviour::whereId($behaviourId)
            ->whereScopedBehaviourSkillSystemId($BehaviourSkillSystemId)
            ->first()
            ->delete();

        return \Response::json(['all' => ScopedBehaviour::with('behaviour_category')->get()]);
    }
}