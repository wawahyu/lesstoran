<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Detail_Order;

use DB;
use DataTables;

class OrderListController extends Controller
{
    public function list_order_datatables(){
        DB::statement(DB::raw('set @rownum=0'));
        $order = Order::query()
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
            if($order->status == 1){
                return 'Pesanan Sedang Dibuat';
            }
            if ($order->status == 2) {
                return 'Pesanan Sudah Dibuat';
            }
            if ($order->status == 3) {
                return 'Pesanan Sudah Diantar';
            }
            if ($order->status == 4) {
                return 'Pesanan Sudah Dibayar';
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
            $string = substr($string, 0, -2).'.';
            return $string;
        });

        return $datatables->make(true);
    }
}
