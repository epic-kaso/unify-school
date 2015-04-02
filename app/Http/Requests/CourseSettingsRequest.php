<?php namespace UnifySchool\Http\Requests;

use UnifySchool\Http\Controllers\School\Resources\Configurations\CourseSettingsController;
use UnifySchool\Http\Requests\Request;

class CourseSettingsRequest extends Request {

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
		$action = $this->get('action', 'default');

		switch ($action) {
			case CourseSettingsController::$action_add_course_category:
				return [
					'name' => 'required',
					'school_category_id' => 'required|integer'
				];
			default:
				return [
				];
		}
	}

}
