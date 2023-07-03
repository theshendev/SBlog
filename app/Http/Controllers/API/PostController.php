<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.userId')->only('store');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id)->load('comments','user');
        return response()->json(new PostResource($post));
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $data['user_id']= $request->header('User-ID');
        $post = Post::create($data);
        return response()->json([
            'id' => $post->id
        ],201);
    }
}
