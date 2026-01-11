<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = [
        'post_id',
        'account_id',
        'parent_id',
        'comment',
    ];

    // Parent Comment
    public function parent()
    {
        return $this->belongsTo(PostComment::class, 'parent_id');
    }

    // Reply
    public function replies()
    {
        return $this->hasMany(PostComment::class, 'parent_id')->latest();
    }
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
