<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_Order extends Model
{
    protected $table = 'detail_orders';
    public $primaryKey = 'id';

    protected $fillable = [
        'id_order', 'id_masakan', 'id_user', 'qty', 'keterangan', 'status'
    ];
}
