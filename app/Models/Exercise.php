<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'duration',
        'exercise_steps',
        'tips',
        'is_active',
    ];
}
