<?php namespace UnifySchool\Http\Requests\Modules\Admin\Students;

use UnifySchool\Http\Requests\Request;

class StudentsRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name' => 'required',
            'first_name' => 'required',
            'birth_date' => 'required',
            'sex'        => 'required',
            'school_class' => 'required',
        ];
    }

}
