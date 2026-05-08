<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\RegisterService;

class RegisterController extends Controller
{
    public function __construct(
        protected RegisterService $registerService
    ) {}

    public function store(Request $request)
    {
        return $this->registerService->store($request);
    }
}