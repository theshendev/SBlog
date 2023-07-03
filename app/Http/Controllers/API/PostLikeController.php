<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller {

    public function like($id)
    {
        $post = Post::findOrFail($id);

        $like = $post->like();

        return $like;
    }

    public function dislike($id)
    {
        $post = Post::findOrFail($id);

        $like = $post->dislike();

        return $like;
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $like =  $post->likes->where('user_id', request()->header('User-ID'))->firstOrFail();
            $like->delete();
        return response()->json([], 204);

    }
}
