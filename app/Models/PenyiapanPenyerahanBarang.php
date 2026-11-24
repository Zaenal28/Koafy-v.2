<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenyiapanPenyerahanBarang extends Model
{
    protected $table = 'penyiapan_penyerahan_barang';

    protected $fillable = [
        'id_transaksi',
        'jasa_pengiriman',
        'no_resi',
        'status_pengiriman',
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
}
