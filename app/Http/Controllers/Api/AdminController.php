<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;

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