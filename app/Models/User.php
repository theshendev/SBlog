<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'username',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(Post::class,'favorites','user_id','post_id');
    }
}
