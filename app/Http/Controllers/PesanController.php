<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    // Ambil semua pesan (untuk admin)
    public function index()
    {
        $pesan = Pesan::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar pesan berhasil diambil',
            'data' => $pesan
        ]);
    }

    // Simpan pesan baru dari form kontak
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'telepon' => 'nullable|string|max:20',
            'pesan' => 'required|string',
        ]);

        $pesan = Pesan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'pesan' => $request->pesan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim!',
            'data' => $pesan
        ], 201);
    }

    // Hapus pesan
    public function destroy($id)
    {
        $pesan = Pesan::find($id);

        if (!$pesan) {
            return response()->json([
                'success' => false,
                'message' => 'Pesan tidak ditemukan'
            ], 404);
        }

        $pesan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus'
        ]);
    }
}
