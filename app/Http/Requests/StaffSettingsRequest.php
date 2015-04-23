<?php namespace UnifySchool\Http\Requests;

class StaffSettingsRequest extends Request
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
        if ($this->is('post')) {
            return [
                'last_name' => 'required',
                'first_name' => 'required',
                'sex' => 'required',
                'contact_phone' => 'required',
                'contact_address' => 'required',
            ];
        } else {
            return [];
        }
    }

}
