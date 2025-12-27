<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        "test_attempt_id",
        "test_question_id",
        "answer",
    ];

    protected $casts = [
        'answer' => 'boolean',
    ];

    public function attempt()
    {
        return $this->belongsTo(TestAttempt::class, 'test_attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(TestQuestion::class, 'test_question_id');
    }
}
