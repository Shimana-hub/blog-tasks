<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
{
    return $this->hasMany(Comment::class)->with('replies');
}


    protected $fillable = ['title', 'body', 'user_id'];
}
