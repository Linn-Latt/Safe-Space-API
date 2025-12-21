<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodFeedback extends Model
{
    protected $fillable = [
        'min_average_mood',
        'max_average_mood',
        'title',
        'feedback',
    ];
}
