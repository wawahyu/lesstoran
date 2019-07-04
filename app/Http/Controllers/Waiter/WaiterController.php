<?php

namespace App\Http\Controllers\Waiter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WaiterController extends Controller
{
    public function dashboard(){
    	$title = 'Dashboard Waiter';
        return view('waiter.index', compact('title'));
    }
}
