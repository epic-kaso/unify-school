<?php namespace UnifySchool\Http\Requests;

class CreateSchoolRequest extends Request
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
        if ($this->isMethod('post')) {
            return [
                'city' => 'required',
                'state' => 'required|integer',
                'country' => 'required|integer',
                'name' => 'required|unique:schools,name',
                'selected_school_type' => 'required|integer',
            ];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'id' => 'required|integer',
                'slug' => 'required|exists:schools,slug',
                'school_type' => 'required|array',
                'admin_email' => 'required_if:action,admin_login_details_update|email',
                'admin_password' => 'required_with:admin_email|confirmed',
            ];
        } else {
            return [

            ];
        }
    }

}
