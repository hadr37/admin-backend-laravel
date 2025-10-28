<?php

namespace App\Http\Controllers;

use App\Models\Penawaran;
use Illuminate\Http\Request;

class PenawaranController extends Controller
{
    // Simpan penawaran dari user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'telepon' => 'required|string|max:20',
            'pesan' => 'nullable|string',
        ]);

        $penawaran = Penawaran::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Penawaran berhasil dikirim',
            'data' => $penawaran,
        ]);
    }

    // Lihat semua penawaran (untuk admin)
    public function index()
    {
        $penawaran = Penawaran::with('barang')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $penawaran
        ]);
    }

    // Hapus penawaran
    public function destroy($id)
    {
        $penawaran = Penawaran::find($id);

        if (!$penawaran) {
            return response()->json([
                'success' => false,
                'message' => 'Penawaran tidak ditemukan'
            ], 404);
        }

        $penawaran->delete();

        return response()->json([
            'success' => true,
            'message' => 'Penawaran berhasil dihapus'
        ]);
    }
}
