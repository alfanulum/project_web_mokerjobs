<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Lowongan::count();
        $pending = Lowongan::where('status', 'pending')->count();
        $approved = Lowongan::where('status', 'accept')->count();
        $rejected = Lowongan::where('status', 'decline')->count();

        return view('admin.dashboard', compact('total', 'pending', 'approved', 'rejected'));
    }
}
