<?php

namespace App\Http\Controllers\Admin;

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
        $title = 'Pembayaran';
        return view('admin.transaction.index', compact('title'));
    }

    // Transaction Datatables
    public function transaction_datatables(){
        DB::statement(DB::raw('set @rownum=0'));
        $order = Order::query()
        ->where('status', 2)
        ->where('id_user', Auth::user()->id)
        ->leftJoin('users', 'orders.id_user', 'users.id')
        ->leftJoin('mejas', 'orders.id_meja', 'mejas.id')
        ->get([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'orders.id as id',
            'orders.id_user as id_user',
            'orders.id_meja as id_meja',
            'orders.status as status',
            'users.name as nama_user',
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
