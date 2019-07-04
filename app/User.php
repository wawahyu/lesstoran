<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Role;
use App\Models\Detail_Order;
use App\Models\Order;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    public $primaryKey = 'id';

    protected $fillable = [
        'name', 'username', 'email', 'password', 'id_role', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function myRoleName()
    {
        $role = Role::where('id', Auth::User()->id_role)->get('nama')->first();
        $status = $role->nama;
        return $status;
    }
    
    public function myOrderCount()
    {
        $detailOrder = Detail_Order::where('id_user', Auth::user()->id)->where('status', 1)->get('id');
        foreach ($detailOrder as $data) {
            $jumlah[] = $data->id;
        }
        if (isset($jumlah)) {
            $hasil = sizeof($jumlah);
        }
        else{
            $hasil = 0;
        }
        return $hasil;
    }

    public function myTransactionCount()
    {
        $order = Order::where('id_user', Auth::user()->id)->where('status', 2)->get('id');
        foreach ($order as $data) {
            $jumlah[] = $data->id;
        }
        if (isset($jumlah)) {
            $hasil = sizeof($jumlah);
        }
        else{
            $hasil = 0;
        }
        return $hasil;
    }

    public function waiterOrderCount()
    {
        $order = Order::where('status', 1)->get('id');
        foreach ($order as $data) {
            $jumlah[] = $data->id;
        }
        if (isset($jumlah)) {
            $hasil = sizeof($jumlah);
        }
        else{
            $hasil = 0;
        }
        return $hasil;
    }

    public function cashierOrderCount()
    {
        $order = Order::where('status', 3)->get('id');
        foreach ($order as $data) {
            $jumlah[] = $data->id;
        }
        if (isset($jumlah)) {
            $hasil = sizeof($jumlah);
        }
        else{
            $hasil = 0;
        }
        return $hasil;
    }

    public function myOrderCountGuest()
    {
        $detailOrder = Detail_Order::where('ip_user', request()->ip())->where('status', 1)->get('id');
        foreach ($detailOrder as $data) {
            $jumlah[] = $data->id;
        }
        if (isset($jumlah)) {
            $hasil = sizeof($jumlah);
        }
        else{
            $hasil = 0;
        }
        return $hasil;
    }

    public function myTransactionCountGuest()
    {
        $order = Order::where('ip_user', request()->ip())->where('status', 2)->get('id');
        foreach ($order as $data) {
            $jumlah[] = $data->id;
        }
        if (isset($jumlah)) {
            $hasil = sizeof($jumlah);
        }
        else{
            $hasil = 0;
        }
        return $hasil;
    }
}
