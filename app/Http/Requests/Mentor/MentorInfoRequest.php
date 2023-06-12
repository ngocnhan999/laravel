<?php

namespace App\Http\Requests\Mentor;

use Illuminate\Foundation\Http\FormRequest;

class MentorInfoRequest extends FormRequest
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
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        
            $rules = [
                'first_name'           => 'required',
                'last_name'            => 'required',
                'phone'                => 'required',
                /* 'ethnic'               => 'required',
                'dob'                  => 'required',
                'email'                => 'required|email',
                'address'              => 'required',
                'province_id'          => 'required',
                'address_house'        => 'required',
                'province_house_id'    => 'required',
                'gender'               => 'required',
                'facebook_url'         => 'required||regex:' . $regex,
                'phone_number.phone.*' => 'required',
                'phone_number.owner.*' => 'required' */
            ];
       

        return $rules;
    }

    public function messages()
    {
        $request_msg = 'Vui lòng nhập thông tin!';
        return [
            'first_name.required'           => $request_msg,
            'last_name.required'            => $request_msg,
            'phone.required'                => $request_msg,
            /* 'ethnic.required'               => $request_msg,
            'dob.required'                  => $request_msg,
            'email.required'                => $request_msg,
            'address.required'              => $request_msg,
            'province_id.required'          => $request_msg,
            'address_house.required'        => $request_msg,
            'province_house_id.required'    => $request_msg,
            'gender.required'               => $request_msg,
            'facebook_url.required'         => $request_msg,
            'phone_number.array'            => $request_msg,
            'phone_number.phone.*.required' => $request_msg,
            'phone_number.owner.*.required' => $request_msg */
        ];
    }
}
