<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['kode_barang', 'nama_barang', 'stok', 'kategori_id', 'gambar'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
