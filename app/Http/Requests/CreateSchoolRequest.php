<?php namespace SupergeeksGadgetSwap\Http\Requests;

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
        return [
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'name' => 'required',
            'selected_school_type' => 'required',
        ];
    }

}
