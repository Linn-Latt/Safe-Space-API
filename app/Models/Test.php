<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'name',
        'name_mm',
        'type',
        'description',
        'description_mm',
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
