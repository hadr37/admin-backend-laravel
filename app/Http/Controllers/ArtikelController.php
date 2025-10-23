<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    // GET /api/artikel
    public function index()
    {
        return response()->json(Artikel::latest()->get());
    }

    // GET /api/artikel/{slug}
    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();
        return response()->json($artikel);
    }

    // POST /api/artikel
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:artikels,slug',
            'isi'   => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('artikel', 'public');
        }

        $artikel = Artikel::create($validated);

        return response()->json([
            'message' => 'Artikel berhasil dibuat',
            'data' => $artikel
        ], 201);
    }

    // PUT /api/artikel/{slug}
    public function update(Request $request, $slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:artikels,slug,' . $artikel->id,
            'isi'   => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        // Jika ada cover baru
        if ($request->hasFile('cover')) {
            if ($artikel->cover && Storage::disk('public')->exists($artikel->cover)) {
                Storage::disk('public')->delete($artikel->cover);
            }
            $validated['cover'] = $request->file('cover')->store('artikel', 'public');
        }

        $artikel->update($validated);

        return response()->json([
            'message' => 'Artikel berhasil diperbarui',
            'data' => $artikel
        ]);
    }

    // DELETE /api/artikel/{slug}
    public function destroy($slug)
    {
        $artikel = Artikel::where('slug', $slug)->firstOrFail();

        if ($artikel->cover && Storage::disk('public')->exists($artikel->cover)) {
            Storage::disk('public')->delete($artikel->cover);
        }

        $artikel->delete();

        return response()->json(['message' => 'Artikel berhasil dihapus']);
    }
}
