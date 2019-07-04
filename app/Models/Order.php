<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $primaryKey = 'id';

    protected $fillable = [
        'no_meja', 'id_user', 'keterangan', 'status'
    ];
}
