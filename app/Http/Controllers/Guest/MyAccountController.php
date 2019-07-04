<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;

class MyAccountController extends Controller
{
    // My Account Index
    public function login(){
        $title = 'Masuk';
        return view('guest.login.form', compact('title'));
    }

    public function register(){
        $title = 'Daftar';
        return view('guest.register.form', compact('title'));
    }

    
}
