<?php namespace UnifySchool\Http\Requests;

class BehaviourAssessmentRequest extends Request
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
        return [
            'behaviour_category_id' => 'required|integer',
            'name' => 'required'
        ];
    }

}
