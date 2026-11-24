<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataUser extends Model
{
    protected $table = 'data_users';

    protected $fillable = [
        'id_customer',
        'nama_lengkap',
        'email_akun',
        'no_telpon',
        'tanggal_lahir',
        'gender',
        'tier',
        'avatar',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_customer');
    }
}
