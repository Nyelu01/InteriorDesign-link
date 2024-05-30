<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'phone' => ['required', 'string', 'regex:/^\+?[0-9]{7,15}$/'],
            'cpassword' => 'required|string|min:6|same:password',
            'location' => 'required|string|max:255',
            'service_type' => 'nullable|string|max:255',
            'project_type' => 'nullable|string|max:255',
            'certificate' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'profile_pic' => 'nullable|string|max:255',
            'business_licence' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'acceptable_price' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:10',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'cpassword.same' => 'The password confirmation does not match.',
            'cpassword.required' => 'The confirm password field is required.'
        ];
    }
}
