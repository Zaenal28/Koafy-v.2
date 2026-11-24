<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataAlamatCustomer extends Model
{
    protected $table = 'data_alamat_customers';

    protected $fillable = [
        'id_customer',
        'label_alamat',
        'no_telpon',
        'nama_penerima',
        'alamat_penerima',
        'kecamatan',
        'kode_pos',
        'catatan',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_customer');
    }
}
