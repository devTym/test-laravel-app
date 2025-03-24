<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLinkRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'phonenumber' => 'required|string|regex:/^[0-9]{10}$/',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username field is required.',
            'phonenumber.required' => 'Phone Number field is required.',
            'phonenumber.regex' => 'Phone Number should be 10 digit.',
        ];
    }

}
