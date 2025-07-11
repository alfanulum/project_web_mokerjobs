<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Jobfair;
use App\Models\JobfairEvent;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $year = now()->year;

        // === Data Lowongan ===
        $total = Lowongan::count();
        $pending = Lowongan::where('status', 'pending')->count();
        $approved = Lowongan::where('status', 'accept')->count();
        $rejected = Lowongan::where('status', 'decline')->count();

        // Grafik utama: jumlah lowongan per bulan
        $lokerPerMonth = Lowongan::selectRaw('EXTRACT(MONTH FROM created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupByRaw('EXTRACT(MONTH FROM created_at)')
            ->orderByRaw('EXTRACT(MONTH FROM created_at)')
            ->pluck('total', 'month');

        $chartData = collect(range(1, 12))->mapWithKeys(function ($month) use ($lokerPerMonth) {
            return [$month => $lokerPerMonth->get($month, 0)];
        });

        // Drilldown: status per bulan
        $statuses = ['pending', 'accept', 'decline'];
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $chartDrilldown = [];

        foreach (range(1, 12) as $i) {
            $label = $bulanLabels[$i - 1];
            $chartDrilldown[$label] = [];

            foreach ($statuses as $status) {
                $count = Lowongan::whereYear('created_at', $year)
                    ->whereMonth('created_at', $i)
                    ->where('status', $status)
                    ->count();

                // Ubah ke label user-friendly
                $labelStatus = match ($status) {
                    'pending' => 'Diproses',
                    'accept' => 'Disetujui',
                    'decline' => 'Ditolak',
                    default => ucfirst($status)
                };

                $chartDrilldown[$label][$labelStatus] = $count;
            }
        }

        // === Upcoming Jobfair ===
        $upcomingEvents = JobfairEvent::whereDate('date_start', '>=', Carbon::today())
            ->orderBy('date_start')
            ->limit(5)
            ->get();

        return view('admin.dashboard', [
            // Lowongan
            'total' => $total,
            'diproses' => $pending,
            'disetujui' => $approved,
            'ditolak' => $rejected,
            'chartData' => $chartData->values(),
            'chartDrilldown' => $chartDrilldown,

            // Jobfair
            'upcomingEvents' => $upcomingEvents,
        ]);
    }
}
