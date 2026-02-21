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
        $rules = [
            'role' => 'required|in:user,doctor',

            'email' => 'required|email|unique:accounts,email',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[0-9])(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]+$/'
            ],

            // User fields
            'nickname' => 'required_if:role,user|string|max:255',

            // Doctor fields
            'name' => 'required_if:role,doctor|string|max:150',
            'medical_degree' => 'required_if:role,doctor|in:MBBS,MD,DO,M.Med.Sc,Other',
            'medical_school_id' => 'required_if:role,doctor|exists:medical_schools,id',
            'graduation_year' => 'required_if:role,doctor|integer|min:1950|max:' . date('Y'),
            'specialization' => 'required_if:role,doctor|in:general_medicine,psychiatry',
            'license_number' => 'required_if:role,doctor|string|max:30|unique:doctors,license_number',
            'license_expiry_date' => 'required_if:role,doctor|date|after:today',
            'license_authority' => 'nullable|string|max:150',
            'years_of_experience' => 'required_if:role,doctor|integer|min:0|max:50',
            'is_currently_practicing' => 'required_if:role,doctor|boolean',
            'practice_city' => 'required_if:role,doctor|string|max:100',
            'practice_state' => 'required_if:role,doctor|string|max:100',
            'clinic_name' => 'nullable|string|max:150',
            'clinic_registration_number' => 'nullable|string|max:50',
            'professional_memberships' => 'nullable|array',
            'professional_memberships.*' => 'string|max:200',
        ];

        // Only add credentials_confirmed validation for doctor role
        if ($this->input('role') === 'doctor') {
            $rules['credentials_confirmed'] = 'required|accepted';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'credentials_confirmed.accepted' => 'You must confirm that all provided credentials are accurate and truthful.',
            'credentials_confirmed.required_if' => 'Credentials confirmation is required for doctor registration.',
        ];
    }
}
