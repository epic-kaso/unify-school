<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 5/5/2015
 * Time: 12:49 AM
 */

namespace UnifySchool\Http\Requests;

use UnifySchool\Http\Controllers\School\Resources\Configurations\BehaviourSkillSystemController;

class BehaviourSkillSystemRequest extends Request
{

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
            case BehaviourSkillSystemController::Action_Assign_Behaviour_Skill_System:
                return [];
            default:    
                return [
                    'name' => 'required'
                ];
        }
    }

}
