<?php namespace UnifySchool\Http\Requests;

use UnifySchool\Http\Controllers\School\Resources\Configurations\CategoryAndClassesSettingsController;
use UnifySchool\Http\Requests\Request;

class CategoriesAndClassesRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return \Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$action = $this->get('action','default');

		switch($action){
			case CategoryAndClassesSettingsController::$action_school_category:
				if($this->isMethod('POST')){
					return [
						'school_type_id'  => 'required|integer',
						'name'  => 'required'
					];
				}
				return [
					//
				];
			case CategoryAndClassesSettingsController::$action_school_category_arms:
				if($this->isMethod('POST')){
					return [
						'school_category_id'  => 'required|integer',
						'name'  => 'required'
					];
				}
				return [
					//
				];
			case CategoryAndClassesSettingsController::$action_school_category_arm_subarms:
				if($this->isMethod('POST')){
					return [
						'school_category_arm'  => 'required|array'
					];
				}
				return [
					//
				];
			default:
				return [
					//
				];
		}
	}

}
