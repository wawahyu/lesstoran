<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function laporan_index($filter){
        if ($filter == 'masakan') {
            $title = 'Laporan '.ucfirst($filter); 
            return view('owner.laporan.masakan', compact('title'));
        }
        else if($filter == 'pelanggan'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('owner.laporan.pelanggan', compact('title'));   
        }
        else if($filter == 'pesanan'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('owner.laporan.pesanan', compact('title'));   
        }
        else if($filter == 'transaksi'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('owner.laporan.transaksi', compact('title'));   
        }
        else{
            return redirect('owner/dashboard');
        }
    }
}
