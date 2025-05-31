<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProcessedController extends Controller
{
    /**
     * Menampilkan halaman data yang akan diproses/dikelola dengan daftar lowongan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $lowonganList = Lowongan::whereIn('status', ['pending'])
            ->orderBy('created_at', 'desc')
            ->get();

        // 4. Kirim data ke view 'admin.processed'.
        return view('admin.processed', compact('lowonganList'));
    }

    /**
     * Mengupdate status lowongan (misalnya Approve/Reject).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lowongan  $lowongan  (Route Model Binding)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Lowongan $lowongan)
    {
        // Log data yang diterima dari request
        Log::info('Update status request received for Lowongan ID: ' . $lowongan->id);
        Log::info('Request payload: ', $request->all()); // Log semua input
        Log::info('Value for "status" field from request: \'' . $request->input('status') . '\''); // Log spesifik field status

        // Sesuaikan dengan status di database Anda
        $validStatuses = ['accept', 'decline', 'pending'];

        $validator = Validator::make($request->all(), [
            'status' => ['required', Rule::in($validStatuses)],
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed for Lowongan ID: ' . $lowongan->id, $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $oldStatus = $lowongan->status;
            $newStatus = $request->status;

            $lowongan->status = $newStatus;
            $isSaved = $lowongan->save();

            if ($isSaved) {
                Log::info("Status lowongan ID {$lowongan->id} ('{$lowongan->job_name}') diubah dari '{$oldStatus}' menjadi '{$newStatus}'.");
                return response()->json([
                    'success' => true,
                    'message' => "Status untuk lowongan '{$lowongan->job_name}' berhasil diubah menjadi '{$newStatus}'.",
                    'lowongan' => $lowongan
                ]);
            } else {
                Log::error("Gagal menyimpan perubahan status untuk lowongan ID {$lowongan->id} ('{$lowongan->job_name}'). Metode save() return false.");
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memperbarui status lowongan di database (save method returned false).'
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error("Error updating lowongan status ID {$lowongan->id}: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server saat memperbarui status.',
                'error_detail' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail lowongan (opsional, jika Anda punya tombol Detail).
     *
     * @param  \App\Models\Lowongan  $lowongan
     * @return \Illuminate\View\View
     */
    public function show(Lowongan $lowongan)
    {
        // Anda bisa membuat view detail terpisah jika diperlukan
        // misalnya 'admin.lowongan_detail'
        return view('admin.lowongan_detail', compact('lowongan'));
    }
}
