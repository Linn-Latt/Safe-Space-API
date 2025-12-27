<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
    ];

    public function questions()
    {
        return $this->hasMany(TestQuestion::class);
    }

    public function resultRanges()
    {
        return $this->hasMany(TestResultRange::class);
    }

    public function attempts()
    {
        return $this->hasMany(TestAttempt::class);
    }
}
