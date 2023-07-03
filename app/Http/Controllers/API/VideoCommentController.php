<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoCommentController extends Controller
{
    public function store(CommentRequest $request,$id)
    {

        $video = Video::findOrFail($id);
        $data = $request->validated();
        $data['user_id']= $request->header('User-ID');

        $comment = $video->comments()->create($data);
        return response()->json([
            'text' => $comment->text
        ],201);

    }
}
