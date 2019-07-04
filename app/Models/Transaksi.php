<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    public $primaryKey = 'id';

    protected $fillable = [
        'id_user', 'id_order', 'total_harga', 'total_bayar'
    ];
}
