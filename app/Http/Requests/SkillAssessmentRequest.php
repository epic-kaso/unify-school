<?php namespace UnifySchool\Http\Requests;

use UnifySchool\Http\Requests\Request;

class SkillAssessmentRequest extends Request {

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
		return [
			'skill_category_id' => 'required|integer',
			'name' => 'required'
		];
	}

}
