<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/31/2015
 * Time: 2:37 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use UnifySchool\Entities\School\ScopedSkill;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\SkillAssessmentRequest;
use UnifySchool\SkillCategory;

class SkillAssessmentSystemController extends Controller
{

    const ACTION_CATEGORIES = 'categories';

    public function index()
    {
        $action = \Input::get('action', 'default');

        switch ($action) {
            case 'default':
                return ScopedSkill::with('skill_category')->get();
            case self::ACTION_CATEGORIES:
                return SkillCategory::all();
        }

    }

    public function store(SkillAssessmentRequest $request)
    {
        $skill = new ScopedSkill();
        $skill->name = $request->get('name');
        $skill->skill_category_id = $request->get('skill_category_id');
        $skill->save();


        return \Response::json(['all' => ScopedSkill::with('skill_category')->get()]);
    }

    public function show($id)
    {
        return SkillCategory::find($id);
    }

    public function update($id, SkillAssessmentRequest $request)
    {

        return \Response::json(['all' => ScopedSkill::with('skill_category')->get()]);
    }

    public function destroy($id)
    {
        ScopedSkill::destroy($id);
        return \Response::json(['all' => ScopedSkill::with('skill_category')->get()]);
    }
}