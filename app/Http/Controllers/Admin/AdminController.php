<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard(){
    	$title = 'Dashboard Admin';
        return view('admin.index', compact('title'));
    }
}
