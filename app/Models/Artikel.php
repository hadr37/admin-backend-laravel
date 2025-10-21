<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'cover',
    ];

    // Gunakan slug untuk route binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
