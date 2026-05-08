<?php

namespace App\Services;

use Illuminate\Http\Request;

class AdminService
{
    public function dashboard(Request $request)
    {
        // BUG FATAL:
        // role diambil dari URL
        if ($request->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        return response()->json([
            'message' => 'Selamat datang admin'
        ]);
    }
}