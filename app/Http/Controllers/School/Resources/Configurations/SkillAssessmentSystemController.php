<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/31/2015
 * Time: 2:37 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use UnifySchool\Entities\School\ScopedBehaviourSkillSystem;
use UnifySchool\Entities\School\ScopedSkill;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\SkillAssessmentRequest;
use UnifySchool\SkillCategory;

class SkillAssessmentSystemController extends Controller
{

    const ACTION_CATEGORIES = 'categories';

    public function index($BehaviourSkillSystemId)
    {
        $action = \Input::get('action', 'default');

        switch ($action) {
            case 'default':
                return ScopedSkill::with('skill_category')
                    ->whereScopedBehaviourSkillSystemId($BehaviourSkillSystemId)
                    ->get();
            case self::ACTION_CATEGORIES:
                return SkillCategory::all();
        }

    }

    public function store($BehaviourSkillSystemId,SkillAssessmentRequest $request)
    {
        $BehaviourSkillSystem = ScopedBehaviourSkillSystem::findOrFail($BehaviourSkillSystemId);

        $skill = new ScopedSkill();
        $skill->name = $request->get('name');
        $skill->skill_category_id = $request->get('skill_category_id');

        $BehaviourSkillSystem->skills()->save($skill);

        return \Response::json(['all' => ScopedSkill::with('skill_category')->get()]);
    }

    public function show($BehaviourSkillSystemId,$SkillId)
    {
        return ScopedSkill::with('skill_category')
            ->whereId($SkillId)
            ->whereScopedBehaviourSkillSystemId($BehaviourSkillSystemId)
            ->first();
    }

    public function update($BehaviourSkillSystemId,$SkillId, SkillAssessmentRequest $request)
    {
        $skill = ScopedSkill::with('skill_category')
            ->whereId($SkillId)
            ->whereScopedBehaviourSkillSystemId($BehaviourSkillSystemId)
            ->first();
        return \Response::json(['all' => ScopedSkill::with('skill_category')->get()]);
    }

    public function destroy($BehaviourSkillSystemId,$SkillId)
    {
        ScopedSkill::whereId($SkillId)
            ->whereScopedBehaviourSkillSystemId($BehaviourSkillSystemId)
            ->first()
            ->delete();

        return \Response::json(['all' => ScopedSkill::with('skill_category')->get()]);
    }
}