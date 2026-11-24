<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataBarang extends Model
{
    protected $table = 'data_barang';

    protected $fillable = [
        'sku',
        'status',
        'nama_barang',
        'kategori_produk',
        'harga_normal',
        'harga_promo',
        'stok',
        'tanggal_masuk',
        'tanggal_expired',
        'deskripsi_barang',
        'kandungan_ingredients',
        'manfaat_utama',
        'cara_pakai',
        'rekomendasi_tipe_kulit',
        'gambar_produk_1',
        'gambar_produk_2',
        'gambar_produk_3',
        'gambar_produk_4',
    ];

    public function shades(): HasMany
    {
        return $this->hasMany(VarianShadeBarang::class, 'id_barang');
    }
}
