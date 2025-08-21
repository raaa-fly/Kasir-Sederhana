<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = ['pelanggan_id', 'tanggal_penjualan', 'total_harga'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }
    // app/Models/Penjualan.php
public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}
}
