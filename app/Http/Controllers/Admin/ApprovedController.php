<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;

class ApprovedController extends Controller
{
    public function index()
    {
        $lowonganList = Lowongan::whereIn('status', ['accept'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.approved', compact('lowonganList'));
    }
}
