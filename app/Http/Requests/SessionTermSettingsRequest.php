<?php namespace UnifySchool\Http\Requests;

use UnifySchool\Http\Controllers\School\Resources\Configurations\SessionTermSettingsController;
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
		$action = $this->get('action','default');
		if($action === 'default') {
			return [
				'current_session' => 'required',
				'current_sub_session' => 'required|integer'
			];
		}elseif($action === SessionTermSettingsController::$action_save_sub_session_dates){
			return [
				'sub_sessions' => 'required'
			];
		}elseif($action === SessionTermSettingsController::$action_add_sub_session){
			if($this->isMethod('POST')) {
				return [
					'name' => 'required'
				];
			}else{
				return [];
			}
		}else{
			return [];
		}
	}

}
