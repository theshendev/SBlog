<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function index()
    {
        $user = User::find(request()->header('User-ID'));
        return response()->json( $user->favorites->makeHidden('pivot'), 200);
    }
    public function store(Request $request,Post $post)
    {
        $user = User::find($request->header('User-ID'));

        // Check if the post is already marked as a favorite
        if ($user->favorites()->where('post_id', $post->id)->exists()) {
            return response()->json(['message' => 'The post was already marked as favorite.'], 200);
        }

        // Mark the post as a favorite
        $user->favorites()->attach($post);

        return response()->json(['message' => 'The post is marked as favorite.'], 201);
    }



    public function destroy(Post $post)
    {

        User::find(request()->header('User-ID'))->favorites()->detach($post);

        return response()->json([], 204);
    }
}
