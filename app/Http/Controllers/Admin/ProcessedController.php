<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan; // Pastikan model Lowongan ada dan benar path-nya
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProcessedController extends Controller
{

    public function index()
    {
        // Mengambil lowongan dengan status 'pending' untuk ditampilkan di halaman processed
        // Anda bisa menyesuaikan ini jika ingin menampilkan status lain juga (misalnya, 'accept', 'decline')
        $lowonganList = Lowongan::whereIn('status', ['pending']) 
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.processed', compact('lowonganList')); // File blade Anda: resources/views/admin/processed.blade.php
    }

    public function updateStatus(Request $request, Lowongan $lowongan)
    {
        Log::info('Update status request received for Lowongan ID: ' . $lowongan->id . '. Payload: ', $request->all());

        // Status yang valid untuk diubah melalui form ini (sesuai tombol di blade Anda)
        $validStatuses = ['accept', 'decline']; 

        $validator = Validator::make($request->all(), [
            'status' => ['required', Rule::in($validStatuses)],
        ]);

        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            $errorMessageString = 'Validasi gagal: ' . implode(' ', $errorMessages);
            Log::warning('Validation failed for Lowongan ID: ' . $lowongan->id, $validator->errors()->toArray());

            // Redirect kembali dengan error validasi dan input lama
            return redirect()->back()
                             ->withErrors($validator) // Membuat $errors tersedia di Blade
                             ->withInput() // Mengisi kembali form dengan input sebelumnya
                             ->with('error', $errorMessageString); // Key 'error' untuk notifikasi
        }

        $oldStatus = $lowongan->status;
        $newStatus = $request->input('status');

        // Jika status tidak benar-benar berubah, redirect dengan pesan info (opsional)
        if ($oldStatus === $newStatus) {
            // Anda bisa menggunakan 'success' atau 'info' atau key lain jika punya style notifikasi berbeda
            return redirect()->back()->with('success', "Status lowongan '{$lowongan->job_name}' sudah '{$newStatus}'. Tidak ada perubahan.");
        }

        try {
            $lowongan->status = $newStatus;
            $isSaved = $lowongan->save();

            if ($isSaved) {
                $message = "Status untuk lowongan '{$lowongan->job_name}' berhasil diubah dari '{$oldStatus}' menjadi '{$newStatus}'.";
                Log::info($message . " (Lowongan ID: {$lowongan->id})");
                // Redirect kembali dengan pesan sukses
                return redirect()->back()->with('success', $message); // Key 'success' untuk notifikasi
            } else {
                $errorMessage = "Gagal menyimpan perubahan status untuk lowongan ID {$lowongan->id} ('{$lowongan->job_name}'). Metode save() return false.";
                Log::error($errorMessage);
                // Redirect kembali dengan pesan error
                return redirect()->back()->with('error', 'Gagal memperbarui status lowongan di database (metode save gagal).'); // Key 'error'
            }
        } catch (\Exception $e) {
            $errorMessage = "Error updating lowongan status ID {$lowongan->id} ('{$lowongan->job_name}'): " . $e->getMessage();
            Log::error($errorMessage . " Stack trace: " . $e->getTraceAsString());
            // Redirect kembali dengan pesan error server
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server saat memperbarui status.'); // Key 'error'
        }
    }

    // Detail Job
    public function show(Lowongan $lowongan)
    {
        // Pastikan view 'admin.lowongan_detail' ada atau sesuaikan dengan nama view Anda
        // Misalnya, jika Anda memiliki 'admin.detail_job.blade.php'
        // return view('admin.detail_job', compact('lowongan'));
        return view('admin.lowongan_detail', compact('lowongan'));
    }
}
// Pastikan tidak ada kurung kurawal tambahan di akhir file jika sebelumnya ada.