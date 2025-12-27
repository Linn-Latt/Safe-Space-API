<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResultRange extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        "test_id",
        "label",
        "min_score",
        "max_score",
        "feedback",
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
