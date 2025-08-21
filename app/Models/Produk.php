<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama','barcode', 'harga', 'stok'];

    public function transaksis()
    {
        return $this->belongsToMany(Transaksi::class, 'transaksi_produk')->withPivot('jumlah');
    }
}
