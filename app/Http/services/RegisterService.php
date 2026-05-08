<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class RegisterService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function store(Request $request)
    {
        $user = $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,

            // BUG FATAL:
            // password disimpan mentah
            'password' => $request->password
        ]);

        return response()->json([
            'message' => 'Register berhasil',
            'data' => $user
        ]);
    }
}