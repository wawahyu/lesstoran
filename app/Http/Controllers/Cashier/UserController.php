<?php

namespace App\Http\Controllers\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Transaksi;
use App\Models\Detail_Order;

use DB;
use DataTables;

class UserController extends Controller
{
    // User Index
    public function user_index(){
        $title = 'Pengguna';
        return view('cashier.user.index', compact('title'));
    }

    public function user_filter($filter){
        if ($filter == 'pemilik' || $filter == 'pelanggan' || $filter == 'pegawai' ) {
            # code...
            $title = 'Data '.ucfirst($filter);
            return view('cashier.user.index', compact('title', 'filter'));
        }
        else{
            return redirect('cashier/user');
        }
    }

    // User Datatables
    public function user_datatables(){
        DB::statement(DB::raw('set @rownum=0'));
        $user = User::query()
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

        $datatables = DataTables::of($user)
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
            return redirect('cashier/user/filter/pegawai');
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

    // User Add
    public function user_add($filter){
        if ($filter == 'pemilik' || $filter == 'pelanggan' || $filter == 'pegawai' ) {
            $title = 'Tambah '.ucfirst($filter);
            if ($filter == 'pemilik') {
                return redirect('cashier/user/filter/'.$filter)->with('error', 'Anda tidak bisa menambahkan '.$filter);
            }
            if ($filter == 'pelanggan') {
                $id = 2;
            }
            if ($filter == 'pegawai') {
                return redirect('cashier/user/filter/'.$filter)->with('error', 'Anda tidak bisa menambahkan '.$filter);
            }
        return view('cashier.user.form', compact('title', 'id', 'filter'));
        }
        else{
            return redirect('cashier/user');
        }
    }

    public function user_store(Request $request){
        $user = User::get()->all();
        foreach ($user as $key) {
            if ($key->username == $request->username) {
                if ($request->id_role == 4) {
                    return redirect('cashier/user/pemilik/add')->with('error', 'Username Sudah Digunakan, Coba Gunakan Username yang Lain');
                }
                else if ($request->id_role == 5) {
                    return redirect('cashier/user/pelanggan/add')->with('error', 'Username Sudah Digunakan, Coba Gunakan Username yang Lain');
                }
                else{
                    return redirect('cashier/user/pegawai/add')->with('error', 'Username Sudah Digunakan, Coba Gunakan Username yang Lain');
                }
            }else if($key->email == $request->email){
                if ($request->id_role == 4) {
                    return redirect('cashier/user/pemilik/add')->with('error', 'Email Sudah Digunakan, Coba Gunakan Email yang Lain');
                }
                else if ($request->id_role == 5) {
                    return redirect('cashier/user/pelanggan/add')->with('error', 'Email Sudah Digunakan, Coba Gunakan Email yang Lain');
                }
                else{
                    return redirect('cashier/user/pegawai/add')->with('error', 'Email Sudah Digunakan, Coba Gunakan Email yang Lain');
                }
            }
        }

        $user = new User;
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->username);
        $user->id_role = $request->id_role;
        $status = $user->save();
        if ($status) {
            if ($request->id_role == 4) {
                return redirect('cashier/user/filter/pemilik')->with('success','Data Berhasil <a href="#">Ditambahkan</a>');
            }
            else if ($request->id_role == 5) {
                return redirect('cashier/user/filter/pelanggan')->with('success','Data Berhasil <a href="#">Ditambahkan</a>');
            }
            else{
                return redirect('cashier/user/filter/pegawai')->with('success','Data Berhasil <a href="#">Ditambahkan</a>');

            }
        }else
        {
            return redirect()->back()->with('error', 'Data Gagal Ditambahkan');
        }
    }

    // User Edit
    public function user_edit($filter, $id){
        if ($filter == 'pemilik' || $filter == 'pelanggan' || $filter == 'pegawai' ) {
            $title = 'Edit '.ucfirst($filter);
            $data = User::where('id', $id)->first();
            if ($filter == 'pemilik') {
                $id = 1;
            }
            if ($filter == 'pelanggan') {
                $id = 2;
            }
            if ($filter == 'pegawai') {
                $id = 3;
            }
            return view('cashier.user.form', compact('title', 'id', 'filter', 'data'));
        }
        else{
            return redirect('cashier/user/filter/pelanggan');
        }
    }

    public function user_update(Request $request, $id){
        $user = User::where('id', '!=', $id)->get();
        foreach ($user as $key) {
            if ($key->username == $request->username) {
                if ($request->id_role == 4) {
                    return redirect('cashier/user/pemilik/'.$id.'/edit')->with('error', 'Username Sudah Digunakan, Coba Gunakan Username yang Lain');
                }
                else if ($request->id_role == 5) {
                    return redirect('cashier/user/pelanggan/'.$id.'/edit')->with('error', 'Username Sudah Digunakan, Coba Gunakan Username yang Lain');
                }
                else{
                    return redirect('cashier/user/pegawai/'.$id.'/edit')->with('error', 'Username Sudah Digunakan, Coba Gunakan Username yang Lain');
                }
            }else if($key->email == $request->email){
                if ($request->id_role == 4) {
                    return redirect('cashier/user/pemilik/'.$id.'/edit')->with('error', 'Email Sudah Digunakan, Coba Gunakan Email yang Lain');
                }
                else if ($request->id_role == 5) {
                    return redirect('cashier/user/pelanggan/'.$id.'/edit')->with('error', 'Email Sudah Digunakan, Coba Gunakan Email yang Lain');
                }
                else{
                    return redirect('cashier/user/pegawai/'.$id.'/edit')->with('error', 'Email Sudah Digunakan, Coba Gunakan Email yang Lain');
                }
            }
        }

        $user = User::where('id', $id)->first();
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->id_role = $request->id_role;
        $status = $user->update();

        if ($status) {
            if ($request->id_role == 4) {
                # code...
                return redirect('cashier/user/filter/pemilik')->with('success','Data Berhasil <a href="#">Diubah</a>');
            }
            else if ($request->id_role == 5) {
                # code...
                return redirect('cashier/user/filter/pelanggan')->with('success','Data Berhasil <a href="#">Diubah</a>');
            }
            else{
                return redirect('cashier/user/filter/pegawai')->with('success','Data Berhasil <a href="#">Diubah</a>');

            }
        }else
        {
            return redirect()->back()->with('error', 'Data Gagal Diubah');
        }
    }

    // User Delete
    public function user_delete(Request $request){
        $output = 'Error';
        $user = User::where('id',$request->get('id'))->first();
        if($user->delete()){
            $output = 'Success';
         }

        echo json_encode($output);
    }
}
