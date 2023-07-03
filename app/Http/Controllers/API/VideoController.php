<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller {

    public function __construct()
    {
        $this->middleware('auth.userId')->only('store');
    }

    public function show($id)
    {
        $video = Video::findOrFail($id)->load('comments', 'user');

        return response()->json(new VideoResource($video));
    }

    public function store(VideoRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->header('User-ID');
        $video = Video::create($data);

        return response()->json([
            'id' => $video->id,
        ], 201);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'video' => 'required|mimetypes:video/mp4',
        ]);

        // Get the uploaded file
        $videoFile = $request->file('video');

        // Generate a unique file name for the uploaded video and remove all of the whitespaces to avoid any problems
        $fileName = time() . '_' . str_replace(' ', '',$videoFile->getClientOriginalName());

        // Store the uploaded video in the public/videos directory with the new name
        $videoPath = $videoFile->storeAs('videos', $fileName);

        // Generate the full URL of the uploaded video
        $videoUrl = asset($videoPath);

        return response()->json(['url'=> $videoUrl],201);

    }
}
