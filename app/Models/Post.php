<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'account_id',
        'title',
        'content',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }
}
