<?php namespace UnifySchool\Http\Requests;

class ModuleSettingsRequest extends Request
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
            'name' => 'required|unique:modules',
            'school_type_id' => 'required|integer',
            'path' => 'required',
            'menu' => 'required|array',
            'data' => 'array',
            'actions' => 'array',
        ];
    }

}
