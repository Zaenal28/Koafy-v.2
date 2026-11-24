<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'no_telpon',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function dataUser(): HasOne
    {
        return $this->hasOne(DataUser::class, 'id_customer');
    }

    public function alamatCustomers(): HasMany
    {
        return $this->hasMany(DataAlamatCustomer::class, 'id_customer');
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_customer');
    }
}
