<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/31/2015
 * Time: 2:37 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use UnifySchool\SkillCategory;
use UnifySchool\Http\Requests\SkillAssessmentRequest;
use UnifySchool\Http\Controllers\Controller;

class SkillAssessmentSystemController extends Controller {

    public function index(){
        return SkillCategory::all();
    }

    public function store(SkillAssessmentRequest $request){

    }

    public function show($id){
        return SkillCategory::find($id);
    }

    public function update($id, SkillAssessmentRequest $request){

    }

    public function delete($id){

    }
}