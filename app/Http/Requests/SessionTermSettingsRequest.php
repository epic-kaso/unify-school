<?php namespace UnifySchool\Http\Requests;

use UnifySchool\Http\Requests\Request;

class SessionTermSettingsRequest extends Request {

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
		if($this->get('action','default') === 'default') {
			return [
				'current_session' => 'required',
				'current_sub_session' => 'required|integer'
			];
		}else{
			return [];
		}
	}

}
