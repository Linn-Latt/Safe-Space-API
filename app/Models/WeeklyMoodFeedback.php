<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyMoodFeedback extends Model
{
    protected $fillable = [
        'account_id',
        'mood_feedback_id',
        'start_date',
        'end_date',
        'average_mood',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'average_mood' => 'decimal:2',
    ];

    public function feedback()
    {
        return $this->belongsTo(MoodFeedback::class, 'mood_feedback_id');
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
