<?php

namespace App\Http\Requests\V1\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // allow public access
    }

    public function rules()
    {
        return [
            'role' => 'required|in:user,doctor',

            'email' => 'required|email|unique:accounts,email',
            'password' => 'required|min:8|confirmed',

            // User fields
            'nickname' => 'required_if:role,user|string|max:255',

            // Doctor fields
            'name' => 'required_if:role,doctor|string|max:255',
            'license_number' => 'required_if:role,doctor|string|unique:doctors,license_number',
            'certificate' => 'required_if:role,doctor|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'specialization' => 'required_if:role,doctor|string|max:255',
        ];
    }
}
