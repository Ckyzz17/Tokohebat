<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // cek login
        if (!auth()->check()) {

            return response()->json([
                'message' => 'Unauthenticated'
            ], 401);
        }

        // FIX:
        // role diambil dari database/session
        // bukan dari URL
        if (auth()->user()->role !== 'admin') {

            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        return $next($request);
    }
}