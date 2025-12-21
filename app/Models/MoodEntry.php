<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MoodEntry extends Model
{
    protected $fillable = [
        'account_id',
        'mood_score',
        'mood_date',
    ];

    protected $casts = [
        'mood_date' => 'date',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
