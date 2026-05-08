<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class AuthService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function login(Request $request)
    {
        $user = $this->userRepository->findByEmail(
            $request->email
        );

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        // BUG FATAL:
        // password tidak dicek sama sekali
        Auth::login($user);

        return response()->json([
            'message' => 'Login berhasil',
            'user' => $user
        ]);
    }
}