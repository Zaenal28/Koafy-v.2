<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'kode_invoice',
        'tanggal',
        'id_customer',
        'nama_customer',
        'alamat',
        'kecamatan',
        'kode_pos',
        'telpon',
        'voucer',
        'diskon_voucer',
        'ongkir',
        'subtotal_pembayaran',
        'total_pembayaran',
        'metode_pembayaran',
        'tipe_pembayaran',
        'status_pembayaran',
        'nama_rekening_pengirim',
        'bank_pengirim',
        'bukti_transfer',
        'is_notif_read',
    ];

    protected $casts = [
        'is_notif_read' => 'boolean',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_customer');
    }

    public function details(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    public function transaksiBarang(): HasMany
    {
        return $this->hasMany(DataTransaksiBarang::class, 'id_transaksi');
    }

    public function pengiriman(): HasOne
    {
        return $this->hasOne(PenyiapanPenyerahanBarang::class, 'id_transaksi');
    }
}
