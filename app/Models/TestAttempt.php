<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    protected $fillable = [
        "account_id",
        "test_id",
        "total_score",
        "result_label",
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function answers()
    {
        return $this->hasMany(TestAnswer::class);
    }

    public function resultRange()
    {
        return $this->hasOneThrough(
            TestResultRange::class,
            Test::class,
            'id', // Foreign key on Test table
            'test_id', // Foreign key on TestResultRange table
            'test_id', // Local key on TestAttempt table
            'id' // Local key on Test table
        )->where('min_score', '<=', $this->total_score)
         ->where('max_score', '>=', $this->total_score);
    }
}
