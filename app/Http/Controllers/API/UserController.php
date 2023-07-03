<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json([
            'username' => $user->username
        ]);
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        return response()->json([
            'id' => $user->id
        ],201);
    }

}
