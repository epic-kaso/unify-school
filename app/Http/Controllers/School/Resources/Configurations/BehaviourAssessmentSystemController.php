<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/31/2015
 * Time: 2:37 PM
 */

namespace UnifySchool\Http\Controllers\School\Resources\Configurations;


use UnifySchool\BehaviourCategory;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\BehaviourAssessmentRequest;

class BehaviourAssessmentSystemController extends Controller {

    public function index(){
        return BehaviourCategory::all();
    }

    public function store(BehaviourAssessmentRequest $request){
    }

    public function show($id){
        return BehaviourCategory::find($id);
    }

    public function update($id, BehaviourAssessmentRequest $request){

    }

    public function delete($id){

    }
}