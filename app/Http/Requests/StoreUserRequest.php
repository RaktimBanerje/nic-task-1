<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Set to true to allow all users to use this request (or implement custom logic here).
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15', 'regex:/^[\+]?[0-9]{1,4}[ ]?([0-9]{1,3}[ -]?[0-9]{4,6}|[0-9]{2,4}[ -]?[0-9]{6,8})$/'], // Phone number validation
            'designation' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date', 'before:today'], // Ensure the date of birth is valid
            'gender' => ['required', 'in:male,female,other'], // Gender options
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Email validation
        ];
    }

    /**
     * Get custom attributes for validation error messages.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'full name',
            'phone_number' => 'phone number',
            'designation' => 'designation',
            'dob' => 'date of birth',
            'gender' => 'gender',
            'email' => 'email address',
        ];
    }

    /**
     * Get custom error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone_number.regex' => 'The phone number format is invalid.',
            'dob.before' => 'The date of birth must be before today.',
            'gender.in' => 'The selected gender is invalid.',
        ];
    }
}
