<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'account_id',
        'name',
        'medical_degree',
        'medical_school_id',
        'graduation_year',
        'specialization',
        'license_number',
        'license_expiry_date',
        'license_authority',
        'years_of_experience',
        'is_currently_practicing',
        'practice_city',
        'practice_state',
        'clinic_name',
        'clinic_registration_number',
        'professional_memberships',
        'credentials_confirmed',
    ];

    protected $casts = [
        'graduation_year' => 'integer',
        'license_expiry_date' => 'date',
        'years_of_experience' => 'integer',
        'is_currently_practicing' => 'boolean',
        'professional_memberships' => 'array',
        'credentials_confirmed' => 'boolean',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function medicalSchool()
    {
        return $this->belongsTo(MedicalSchool::class);
    }
}
