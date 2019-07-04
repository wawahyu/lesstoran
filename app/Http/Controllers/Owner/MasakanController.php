<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Masakan;
use App\Models\Detail_Order;

use DB;
use DataTables;

class MasakanController extends Controller
{
    public function masakan_datatables(){
        DB::statement(DB::raw('set @rownum=0'));
        $masakan = Masakan::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'nama',
            'harga',
            'status',
            'keterangan',
            'image'
        ]);

        $datatables = DataTables::of($masakan)
        ->addColumn('jumlah_pemesanan', function($masakan){
            $jumlah_pemesanan = 0;
            $data = Detail_Order::where('id_masakan', $masakan->id)->get('qty');
            foreach ($data as $count) {
                $jumlah_pemesanan += 1;
            }
            
            return $jumlah_pemesanan.' pesanan';
        })
        ->addColumn('jumlah_pembelian', function($masakan){
            $jumlah_pembelian = 0;
            $data = Detail_Order::where('id_masakan', $masakan->id)->get('qty');
            foreach ($data as $count) {
                $jumlah_pembelian += $count->qty;
            }
            
            return $jumlah_pembelian.' porsi';
        })
        ->addColumn('filter', function($masakan){
            if ($masakan->keterangan == 1) {
                return 'makanan';
            }
            if ($masakan->keterangan == 2) {
                return 'minuman';
            }
        })
        ->editColumn('image', function($masakan){
            if ($masakan->image == '-') {
                return 'default.png';
            }
            else{
                return $masakan->image;                
            }
        })
        ->editColumn('status', function($masakan){
            if ($masakan->status == 1) {
                return 'Tersedia';
            }
            else{
                return 'Tidak tersedia';
            }
        })
        ->editColumn('keterangan', function($masakan){
            if ($masakan->keterangan == 1) {
                return 'Makanan';
            }
            else if ($masakan->keterangan == 2) {
                return 'Minuman';
            }
            else{
                return '-';
            }
        });

        return $datatables->make(true);
    }
}
