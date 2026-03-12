<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'title',
        'title_mm',
        'slug',
        'symptoms',
        'symptoms_mm',
    ];

    protected $casts = [
        'symptoms' => 'array',
        'symptoms_mm' => 'array',
    ];
}
