<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Detail_Order;
use App\Models\Transaksi;

use DB;
use DataTables;

class UserController extends Controller
{
    public function user_filter_datatables($filter){
        if ($filter == 'pelanggan' || $filter == 'pemilik') {
            if ($filter == 'pelanggan') {
                $filter = 5;
            }
            else if ($filter == 'pemilik') {
                $filter = 4;
            }
            DB::statement(DB::raw('set @rownum=0'));
            $user = User::query()->where('id_role', $filter)
                ->leftJoin('roles', 'users.id_role', 'roles.id')
                ->get([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'users.id as id',
                'users.name as nama',
                'users.username as username',
                'users.email as email',
                'users.id_role as id_role',
                'users.active as active',
                'roles.nama as role_name',
            ]);    
        }
        else if($filter = 'pegawai'){
            DB::statement(DB::raw('set @rownum=0'));
            $user = User::query()->where('id_role', '!=', 4)->where('id_role', '!=', 5)
                ->leftJoin('roles', 'users.id_role', 'roles.id')
                ->get([
                DB::raw('@rownum  := @rownum  + 1 AS rownum'),
                'users.id as id',
                'users.name as nama',
                'users.username as username',
                'users.email as email',
                'users.id_role as id_role',
                'users.active as active',
                'roles.nama as role_name',
            ]);
        }
        else{
            return redirect('admin/user/filter/pegawai');
        }
        

        $datatables = DataTables::of($user)
        ->addColumn('jumlah_pemesanan', function($user){
            $jumlah_pemesanan = 0;
            $data = Detail_Order::where('id_user', $user->id)->get('id');
            foreach ($data as $count) {
                $jumlah_pemesanan +=1 ;
            }
            return $jumlah_pemesanan.' kali';
        })
        ->addColumn('jumlah_transaksi', function($user){
            $jumlah_transaksi = 0;
            $data = Transaksi::where('id_user', $user->id)->get('id');
            foreach ($data as $count) {
                $jumlah_transaksi +=1 ;
            }
            return $jumlah_transaksi.' kali';
        })
        ->editColumn('active', function($user){
            if ($user->active == 1) {
                return 'aktif';
            }

            if ($user->active == 2) {
                return 'resign';
            }
        })->addColumn('filter', function($user){
            if ($user->id_role == 4) {
                return 'pemilik';
            }
            if ($user->id_role == 5) {
                return 'pelanggan';
            }
            if ($user->id_role >= 1 && $user->id_role <= 3 ) {
                return 'pegawai';
            }
        });

        return $datatables->make(true);
    }
}
