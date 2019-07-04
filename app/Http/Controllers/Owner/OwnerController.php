<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OwnerController extends Controller
{
    public function dashboard(){
    	$title = 'Dashboard Owner';
        return view('owner.index', compact('title'));
    }
}
