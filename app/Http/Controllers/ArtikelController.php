<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    // GET /api/artikel
    public function index()
    {
        return response()->json(Artikel::latest()->get());
    }

    // GET /api/artikel/{slug}
    public function show(Artikel $artikel)
    {
        return response()->json($artikel);
    }

    // POST /api/artikel
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:artikels,slug',
            'isi'   => 'required|string',
            'cover' => 'nullable|image|max:10240', // 10MB
        ]);

        $data = $request->only(['judul', 'slug', 'isi']);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('cover', 'public');
        }

        $artikel = Artikel::create($data);

        return response()->json([
            'message' => 'Artikel berhasil dibuat',
            'data' => $artikel
        ], 201);
    }

    // PUT /api/artikel/{slug}
    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:artikels,slug,' . $artikel->id,
            'isi'   => 'required|string',
            'cover' => 'nullable|image|max:10240',
        ]);

        $data = $request->only(['judul', 'slug', 'isi']);

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($artikel->cover && Storage::disk('public')->exists($artikel->cover)) {
                Storage::disk('public')->delete($artikel->cover);
            }
            $data['cover'] = $request->file('cover')->store('cover', 'public');
        }

        $artikel->update($data);

        return response()->json([
            'message' => 'Artikel berhasil diperbarui',
            'data' => $artikel
        ]);
    }

    // DELETE /api/artikel/{slug}
    public function destroy(Artikel $artikel)
    {
        if ($artikel->cover && Storage::disk('public')->exists($artikel->cover)) {
            Storage::disk('public')->delete($artikel->cover);
        }

        $artikel->delete();

        return response()->json(['message' => 'Artikel berhasil dihapus']);
    }
}
