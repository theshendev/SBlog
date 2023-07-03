<?php

namespace App\Traits;


use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait Likable {


    public function likes()
    {
        return $this->morphMany(Like::class,'likable');
    }

    public function like($liked = true)
    {
            return $this->likes()->updateOrCreate(
                [
                    'user_id' => request()->header('User-ID')
                ],
                [
                    'liked' => $liked
                ]
            );
    }

    public function dislike()
    {
        return $this->like(false);
    }

}