<?php

namespace App\Http\Controllers\Cashier;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    // ---------- Laporan
    public function laporan_index($filter){
        if ($filter == 'masakan') {
            $title = 'Laporan '.ucfirst($filter); 
            return view('cashier.laporan.masakan', compact('title'));
        }
        else if($filter == 'pelanggan'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('cashier.laporan.pelanggan', compact('title'));   
        }
        else if($filter == 'pesanan'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('cashier.laporan.pesanan', compact('title'));   
        }
        else if($filter == 'transaksi'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('cashier.laporan.transaksi', compact('title'));   
        }
        else{
            return redirect('cashier/dashboard');
        }
    }
}
