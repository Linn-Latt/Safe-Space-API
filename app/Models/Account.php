<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
}
