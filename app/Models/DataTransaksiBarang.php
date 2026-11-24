<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataTransaksiBarang extends Model
{
    protected $table = 'data_transaksi_barang';

    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'nama_barang',
        'harga',
        'qty',
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
}
