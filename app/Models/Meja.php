<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'mejas';
    public $primaryKey = 'id';

    protected $fillable = [
        'nama'
    ];
}
