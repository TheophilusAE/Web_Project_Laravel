<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // (You can later add admin dashboard logic here, e.g. fetching admin‐only data.)
        return view('admin.dashboard');
    }
} 