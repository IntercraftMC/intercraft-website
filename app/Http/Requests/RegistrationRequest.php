<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\RegisterRequest;

class RegistrationRequest extends FormRequest
{
    public function registerRequest()
    {
        return RegisterRequest::where('token', $this->query('token'))->first();
    }

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
            'email'      => 'required|email|unique:users',
            'username'   => 'required|min:3|max:16|lowercase|alpha_dash|unique:users',
            'password'   => 'required|min:8',
            'repassword' => 'required|same:password',
        ];
    }
}
