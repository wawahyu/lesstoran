<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\Detail_Order;
use App\Models\Order;
use App\Models\Transaksi;

use DB;
use DataTables;

class TransactionListController extends Controller
{
    // Transaction-List Index
    public function transaction_list_index(){
        $title = 'Pembayaran Diterima';
        return view('admin.transaction_list.index', compact('title'));
    }

    // Transaction-List Datatables
    public function transaction_list_datatables(){
        DB::statement(DB::raw('set @rownum=0'));
        $order = Order::query()
        ->where('status', 3)
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
            if($order->status == 3){
                return 'Konfirmasi Pembayaran';
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

    public function list_transaction_datatables(){
        DB::statement(DB::raw('set @rownum=0'));
        $transaksis = Transaksi::query()
        ->leftJoin('users', 'transaksis.id_user', 'users.id')
        ->get([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'transaksis.id as id',
            'users.name as nama',
            'transaksis.total_harga as total_harga',
            'transaksis.total_bayar as total_bayar',
            'transaksis.created_at as tanggal',
        ]);

        $datatables = DataTables::of($transaksis)
        ->editColumn('total_harga', function($transaksis){
            return 'Rp. '.number_format($transaksis->total_harga, 0, ".", ".");
        })
        ->editColumn('total_bayar', function($transaksis){
            return 'Rp. '.number_format($transaksis->total_bayar, 0, ".", ".");
        });

        return $datatables->make(true);
    }

    // Transaction-List Update
    public function transaction_list_update(Request $request, $id){
        $total = 0;
        $detail_orders = Detail_Order::query()
            ->leftJoin('masakans', 'detail_orders.id_masakan', 'masakans.id')
            ->where('id_order', $id)
            ->get(['masakans.harga as harga', 'detail_orders.qty as qty']);
        foreach ($detail_orders as $data) {
            $total += $data->harga*$data->qty;
        }
        if ($request->total_bayar < $total) {
            return redirect('admin/transaction/list')->with('error','Uang Yang Anda Masukkan Kurang.');
        }
        else{
            $order = Order::where('id',$id)->first();
            $order->status = 4; 
            $order->update();

            $transaction = new Transaksi;
            $transaction->id_order = $id;
            $transaction->id_user = Auth::user()->id;
            $transaction->total_harga = $total;
            $transaction->total_bayar = $request->total_bayar;
            $status = $transaction->save();
            if ($status) {
                return redirect('admin/transaction/list')->with('success','Pesanan Berhasil Dibayar <br> Kembaliannya Rp.'.number_format($request->total_bayar-$total), 0, 0)->with('info', '<a href="'.url('admin/transaction/list').'/'.$id.'/print" target="_blank" class="btn btn-info"><i class="fa fa-print"></i> Print</a>');
            }else
            {
                return redirect()->back()->with('error', 'Pesanan Gagal Ditambahkan');
            }    
        }
    }

    public function transaction_list_print($id){
        $title = 'Struk Pembelian';
        $tranasksi = Transaksi::leftJoin('users', 'transaksis.id_user', 'users.id')->where('id_order', $id)->get(['transaksis.id as id', 'transaksis.total_harga as total_harga', 'transaksis.total_bayar as total_bayar', 'users.name as nama', 'transaksis.created_at as created_at'])->first();
        $total_harga = $tranasksi->total_harga;
        $total_bayar = $tranasksi->total_bayar;
        $pelanggan = $tranasksi->nama;
        $created_at = $tranasksi->created_at;

        return view('admin.transaction_list.print', compact('title', 'id', 'total_harga', 'total_bayar', 'pelanggan', 'created_at', 'id'));
    }
}
