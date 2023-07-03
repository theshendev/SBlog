<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIdVerifyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $userId = $request->header('User-ID');
        if (!$userId) {
            return response()->json('Unauthorized', 401);
        }

        User::findOrFail($userId);
        return $next($request);
    }
}
