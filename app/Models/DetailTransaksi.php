<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_customer',
        'id_barang',
        'nama_customer',
        'nama_produk',
        'shade',
        'harga',
        'qty',
        'voucer',
        'ongkir',
        'subtotal',
        'subtotal_pembayaran',
        'total_pembayaran',
        'metode_pembayaran',
        'status_pembayaran',
        'gambar_produk',
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
}
