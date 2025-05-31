<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProcessedController extends Controller
{
    /**
     * Menampilkan halaman data yang telah diproses.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Anda bisa menambahkan logika atau mengambil data untuk halaman processed di sini
        // Misalnya, mengambil data yang statusnya "processed" dari database
        // $processedItems = Item::where('status', 'processed')->get();
        // return view('admin.processed', ['items' => $processedItems]);

        return view('admin.processed'); // Pastikan path view benar
    }
}
