<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\Order;
use App\Models\Detail_Order;

use DB;
use DataTables;

class TransactionController extends Controller
{
    // Transaction Index
    public function transaction_index(){
        $detailOrder = Detail_Order::where('ip_user', "".request()->ip())->where('status', 1)->get('id');
        foreach ($detailOrder as $data) {
            $jumlah[] = $data->id;
        }
        if (isset($jumlah)) {
            $dO = sizeof($jumlah);
        }
        else{
            $dO = 0;
        }
        
        $order = Order::where('ip_user', "".request()->ip())->where('status', 2)->get('id');
        foreach ($order as $data) {
            $jumlah[] = $data->id;
        }
        if (isset($jumlah)) {
            $o = sizeof($jumlah);
        }
        else{
            $o = 0;
        }
        $title = 'Pembayaran';
        return view('guest.transaction.index', compact('title', 'dO', 'o'));
    }

    // Transaction Datatables
    public function transaction_datatables(){
        DB::statement(DB::raw('set @rownum=0'));
        $order = Order::query()
        ->where('status', 2)
        ->where('ip_user', request()->ip())
        ->leftJoin('mejas', 'orders.id_meja', 'mejas.id')
        ->get([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'orders.id as id',
            'orders.ip_user as ip_user',
            'orders.id_meja as id_meja',
            'orders.status as status',
            'mejas.nama as nama_meja',
        ]);

        $datatables = DataTables::of($order)
        ->editColumn('status', function($order){
            if($order->status == 2){
                return 'Lakukan Pembayaran';
            }
        })->addColumn('daftar', function($order){
            $string = "";
            $detail_orders = Detail_Order::query()
                ->leftJoin('masakans', 'detail_orders.id_masakan', 'masakans.id')
                ->where('id_order', $order->id)
                ->get(['masakans.nama as nama', 'detail_orders.qty as qty']);
            foreach ($detail_orders as $data) {
                $string = $string.$data->nama."(".$data->qty."), ";
            }
            $string = $string."";
            return $string;
        })->addColumn('total_harga', function($order){
            $total = 0;
            $detail_orders = Detail_Order::query()
                ->leftJoin('masakans', 'detail_orders.id_masakan', 'masakans.id')
                ->where('id_order', $order->id)
                ->get(['masakans.harga as harga', 'detail_orders.qty as qty']);
            foreach ($detail_orders as $data) {
                $total += $data->harga*$data->qty;
            }
            return $total;
        });

        return $datatables->make(true);
    }

    // Transaction Update
    public function transaction_update(Request $request){
        $output = 'Error';
        $order = Order::where('id',$request->get('id'))->first();
        $order->status = 3; 
        if($order->update()){
            $output = 'Success';
         }

        echo json_encode($output);
    }
}
