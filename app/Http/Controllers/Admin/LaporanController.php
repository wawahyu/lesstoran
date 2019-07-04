<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    // Generate Laporan
    public function laporan_index($filter){
        if ($filter == 'masakan') {
            $title = 'Laporan '.ucfirst($filter); 
            return view('admin.laporan.masakan', compact('title'));
        }
        else if($filter == 'pelanggan'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('admin.laporan.pelanggan', compact('title'));   
        }
        else if($filter == 'pesanan'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('admin.laporan.pesanan', compact('title'));   
        }
        else if($filter == 'transaksi'){
            $title = 'Laporan '.ucfirst($filter); 
            return view('admin.laporan.transaksi', compact('title'));   
        }
        else{
            return redirect('admin/masakan');
        }
    }
}
