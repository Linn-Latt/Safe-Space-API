<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalSchool extends Model
{
    protected $fillable = [
        'name',
        'country',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
