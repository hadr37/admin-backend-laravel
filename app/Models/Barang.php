<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'deskripsi',
        'stok',
        'harga',
        'gambar'
    ];

    public function kategori()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}

