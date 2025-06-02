<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;

class RejectedController extends Controller
{
    public function index()
    {
        $lowonganList = Lowongan::whereIn('status', ['decline'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.rejected', compact('lowonganList'));
    }
}
