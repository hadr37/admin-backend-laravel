<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->get();
        return response()->json($barang);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama_barang' => 'required|string',
            'kategori_id' => 'required|exists:categories,id',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        $barang = Barang::create($data);

        return response()->json($barang, 201);
    }

    public function show($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);
        return response()->json($barang);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string',
            'kategori_id' => 'required|exists:categories,id', 
            'stok' => 'required|integer',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        $barang->update($data);

        return response()->json($barang);
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return response()->json(['message' => 'Barang berhasil dihapus']);
    }
}
