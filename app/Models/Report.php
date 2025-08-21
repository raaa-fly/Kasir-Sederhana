<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['tanggal', 'total_item', 'total_pemasukan'];
}
