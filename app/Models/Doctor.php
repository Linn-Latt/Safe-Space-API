<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'account_id',
        'name',
        'license_number',
        'certificate',
        'specialization',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
