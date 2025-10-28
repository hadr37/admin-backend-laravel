<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'nama',
        'email',
        'telepon',
        'pesan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
