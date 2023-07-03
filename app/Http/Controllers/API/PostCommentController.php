<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(CommentRequest $request,$id)
    {
        $post = Post::findOrFail($id);
        $data = $request->validated();
        $data['user_id']= $request->header('User-ID');
        $comment = $post->comments()->create($data);
        return response()->json([
            'text' => $comment->text
        ],201);
    }
}
