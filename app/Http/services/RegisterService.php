<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Repositories\UserRepository;

class RegisterService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8']
        ]);

        $user = $this->userRepository->create([
            'name' => $validated['name'],
            'email' => $validated['email'],

            // FIX:
            // password di-hash
            'password' => Hash::make($validated['password'])
        ]);

        return response()->json([
            'message' => 'Register berhasil',
            'data' => $user
        ]);
    }
}