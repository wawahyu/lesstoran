<?php

namespace App\Http\Controllers\Waiter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function laporan_index($filter){
        if ($filter == 'masakan') {
            $title = 'Laporan '.ucfirst($filter); 
            return view('waiter.laporan.masakan', compact('title'));
        }
        else if($filter == 'pelanggan'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('waiter.laporan.pelanggan', compact('title'));   
        }
        else if($filter == 'pesanan'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('waiter.laporan.pesanan', compact('title'));   
        }
        else if($filter == 'transaksi'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('waiter.laporan.transaksi', compact('title'));   
        }
        else{
            return redirect('waiter/dashboard');
        }
    }
}
