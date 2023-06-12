<?php

namespace App\Http\Requests\Mentor;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class MentorRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->method();
        /* return [
            'username'      => 'required:mentors,username,' . $this->id . ',id',
        ]; */
        $rules = [
            'username'      => 'required:mentors,username,' . $this->id . ',id',
            'email'      => 'required',
            'password'      => 'required',
            'password_confirmation' => 'required',
        ];
        if($this->request->get('password')!=$this->request->get('password_confirmation')){
            $rules['confirmed']       = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'username.required' => 'Tên của bạn không được bỏ trống.',
            'email.required' => 'Email của bạn không được bỏ trống.',
            'password.required' => 'Mật Khẩu của bạn không được bỏ trống.',
            'confirmed.required' => 'Nhập lại mật khẩu chưa chính xác.',
            'password_confirmation.required' => 'Mật Khẩu của bạn không được bỏ trống.',
        ];
    }
}
