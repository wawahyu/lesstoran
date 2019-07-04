<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masakan extends Model
{
    protected $table = 'masakans';
    public $primaryKey = 'id';

    protected $fillable = [
        'nama', 'harga', 'status', 'image'
    ];
}
