<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegisterService;

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