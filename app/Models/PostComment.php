<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = [
        'post_id',
        'account_id',
        'comment',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
