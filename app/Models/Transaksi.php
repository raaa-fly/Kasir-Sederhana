<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['pelanggan_id', 'tanggal_transaksi', 'total_harga'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'transaksi_id');
    }
    // app/Models/Transaksi.php
public function kasir()
{
    return $this->belongsTo(User::class, 'kasir_id');
}



}

