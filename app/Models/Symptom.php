<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'symptoms',
    ];

    protected $casts = [
        'symptoms' => 'array',
    ];
}
