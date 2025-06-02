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

        // Data untuk grafik
        $year = now()->year;
        $lokerPerMonth = Lowongan::selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupByRaw('EXTRACT(MONTH FROM created_at)')
            ->orderByRaw('EXTRACT(MONTH FROM created_at)')
            ->pluck('total', 'month');

        // Lengkapi semua bulan dengan 0 jika tidak ada data
        $chartData = collect(range(1, 12))->mapWithKeys(function ($month) use ($lokerPerMonth) {
            return [$month => $lokerPerMonth->get($month, 0)];
        });

        return view('admin.dashboard', [
            'total' => $total,
            'diproses' => $pending,
            'disetujui' => $approved,
            'ditolak' => $rejected,
            'chartData' => $chartData->values(),
        ]);
    }
}
