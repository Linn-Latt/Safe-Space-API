<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'type',
        'title',
        'title_mm',
        'description',
        'description_mm',
        'duration',
        'exercise_steps',
        'exercise_steps_mm',
        'tips',
        'tips_mm',
        'is_active',
    ];

    protected $casts = [
        'exercise_steps' => 'array',
        'exercise_steps_mm' => 'array',
    ];
}
