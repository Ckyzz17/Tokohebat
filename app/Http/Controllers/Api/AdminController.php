<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Services\AdminService;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct(
        protected AdminService $adminService
    ) {}

    public function dashboard(Request $request)
    {
        return $this->adminService->dashboard($request);
    }
}