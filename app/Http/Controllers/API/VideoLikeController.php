<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class VideoLikeController extends Controller
{
    public function like($id)
    {
        $video = Video::findOrFail($id);

        $like = $video->like();
        return $like;
    }

    public function dislike($id)
    {
        $video = Video::findOrFail($id);

        $like = $video->dislike();
        return $like;
    }

    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        // Find the like entity related to the user
        $like =  $video->likes->where('user_id', request()->header('User-ID'))->firstOrFail();

        $like->delete();
        return response()->json([],204);
    }
}
