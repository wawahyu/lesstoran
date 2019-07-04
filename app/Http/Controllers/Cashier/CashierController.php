<?php

namespace App\Http\Controllers\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CashierController extends Controller
{
    public function dashboard(){
    	$title = 'Dashboard Cashier';
        return view('cashier.index', compact('title'));
    }
}
