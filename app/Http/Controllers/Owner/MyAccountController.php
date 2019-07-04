<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;

class MyAccountController extends Controller
{
    // My Account Index
    public function myaccount_index(){
        $title = 'Edit Akun';
        return view('owner.myaccount.form', compact('title'));
    }

    public function myaccount_password(){
        $title = 'Ubah Password';
        return view('owner.myaccount.password', compact('title'));
    }

    // My Account Edit
    public function myaccount_edit(Request $request){
        $user = User::where('id', '!=',Auth::user()->id)->get();
        foreach ($user as $key) {
            if ($key->username == $request->username) {
                return redirect('owner/myaccount')->with('error', 'Username Sudah Digunakan, Coba Gunakan Username yang Lain');
            }else if($key->email == $request->email){
                return redirect('owner/myaccount')->with('error', 'Email Sudah Digunakan, Coba Gunakan Email yang Lain');
            }
        }

        $user = User::where('id', Auth::user()->id)->get()->first();
        $user->name = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        if ($user->save()) {
            return redirect('owner/dashboard')->with('success', 'Akun Berhasil Diubah');
        }
        else{
            return redirect('owner/myaccount')->with('error', 'Akun Gagal Diubah');
        }
    }

    public function myaccount_edit_password(Request $request){
        $user = User::where('id', Auth::user()->id)->get()->first();
        
            if ($request->newpassword == $request->confirmpassword) {
                $user->password = bcrypt($request->newpassword);
                if ($user->save()) {
                    return redirect('owner/dashboard')->with('success', 'Password Berhasil diubah');
                }
                else{
                    return redirect('owner/myaccount/password')->with('error', 'Password Gagal Diubah');
                }
            }
            else{
                return redirect('owner/myaccount/password')->with('error', 'Password Baru dengan Konfirmasi Tidak Sesuai');
            }
    }
}
