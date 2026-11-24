<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VarianShadeBarang extends Model
{
    protected $table = 'varian_shade_barang';

    protected $fillable = [
        'id_barang',
        'nama_shade',
        'kode_warna',
        'gambar_produk',
    ];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(DataBarang::class, 'id_barang');
    }
}
