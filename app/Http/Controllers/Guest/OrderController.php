<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\Models\Detail_Order;
use App\Models\Masakan;
use App\Models\Order;

use DB;
use DataTables;

class OrderController extends Controller
{

    // Order Index
    public function order_index(){
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

        $title = 'Menu';
        return view('guest.order.index', compact('title', 'o', 'dO'));
    }

    public function order_filter($filter){
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
        if ($filter == 'makanan' || $filter == 'minuman') {
            # code...
            $title = 'Daftar '.ucfirst($filter);
            return view('guest.order.index', compact('title', 'filter', 'o', 'dO'));
        }
        else{
            return redirect('/order');
        }
    }

    public function order_myorder_index(){
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
        $title = 'Pesanan';
        return view('guest.order.myindex', compact('title', 'o', 'dO'));
    }

    public function order_myorder_filter($filter){
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
        if ($filter == 'makanan' || $filter == 'minuman') {
            # code...
            $title = 'Daftar '.ucfirst($filter);
            return view('guest.order.myindex', compact('title', 'filter', 'dO', 'o'));
        }
        else{
            return redirect('/order');
        }
    }    

    // Order Datatables
    public function order_datatables(){
        $id[] = '';
        $hidden = Detail_Order::where('ip_user', request()->ip())->where('status', 1)->get('id_masakan');
        foreach ($hidden as $data) {
            $id[] = $data->id_masakan;              
        }
        DB::statement(DB::raw('set @rownum=0'));
        $masakan = Masakan::query()->where('status', 1)
        ->whereNotIn('id', $id)
        ->get([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'nama',
            'harga',
            'status',
            'keterangan',
            'image'
        ]);

        $datatables = DataTables::of($masakan)
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

    public function order_filter_datatables($filter){
        $id[] = '';
        $hidden = Detail_Order::where('ip_user', request()->ip())->where('status', 1)->get('id_masakan');
        foreach ($hidden as $data) {
            $id[] = $data->id_masakan;              
        }
        if ($filter == 'makanan') {
            $filter = 1;
        }
        else if ($filter == 'minuman') {
            $filter = 2;
        }
        else{
            return redirect('/order');
        }
        DB::statement(DB::raw('set @rownum=0'));
        $masakan = Masakan::query()->where('status', 1)
        ->whereNotIn('id', $id)
        ->where('keterangan', $filter)
        ->get([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'nama',
            'harga',
            'status',
            'keterangan',
            'image'
        ]);

        $datatables = DataTables::of($masakan)
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

    public function order_myorder_datatables(){
        DB::statement(DB::raw('set @rownum=0'));
        $detail_orders = Detail_Order::query()
        ->where('detail_orders.ip_user', request()->ip())
        ->where('detail_orders.status', 1)
        ->leftJoin('masakans', 'detail_orders.id_masakan', 'masakans.id')
        ->get([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'detail_orders.id as id',
            'detail_orders.id_masakan as id_masakan',
            'detail_orders.status as status_order',
            'detail_orders.ip_user as ip_user',
            'masakans.nama as nama',
            'masakans.status as status',
            'masakans.harga as harga',
            'masakans.image as image',
            'masakans.keterangan as keterangan',
            'detail_orders.qty as qty'
        ]);

        $datatables = DataTables::of($detail_orders)
        ->addColumn('total_harga', function($detail_orders){
            return 'Rp. '.number_format($detail_orders->harga * $detail_orders->qty, 0, ".", ".");
        })
        ->addColumn('harga_qty', function($detail_orders){
            return $detail_orders->harga.'('.$detail_orders->qty.')';
        })
        ->addColumn('filter', function($detail_orders){
            if ($detail_orders->keterangan == 1) {
                return 'makanan';
            }
            if ($detail_orders->keterangan == 2) {
                return 'minuman';
            }
        })
        ->editColumn('image', function($detail_orders){
            if ($detail_orders->image == '-') {
                if ($detail_orders->keterangan == 1) {
                    return 'masakan.png';
                }
                if ($detail_orders->keterangan == 2) {
                    return 'minuman.png';
                }
            }
            else{
                return $detail_orders->image;                
            }
        })
        ->editColumn('status', function($detail_orders){
            if ($detail_orders->status == 1) {
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

    public function order_myorder_filter_datatables($filter){
        if ($filter == 'makanan') {
            $filter = 1;
        }
        else if ($filter == 'minuman') {
            $filter = 2;
        }
        else{
            return redirect('/order');
        }
        DB::statement(DB::raw('set @rownum=0'));
        $detail_orders = Detail_Order::query()
        ->where('masakans.keterangan', $filter)
        ->where('detail_orders.ip_user', request()->ip())
        ->where('detail_orders.status', 1)
        ->leftJoin('masakans', 'detail_orders.id_masakan', 'masakans.id')
        ->get([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'detail_orders.id as id',
            'detail_orders.id_masakan as id_masakan',
            'detail_orders.status as status_order',
            'detail_orders.ip_user as ip_user',
            'masakans.nama as nama',
            'masakans.status as status',
            'masakans.harga as harga',
            'masakans.image as image',
            'masakans.keterangan as keterangan',
            'detail_orders.qty as qty'
        ]);

        $datatables = DataTables::of($detail_orders)
        ->addColumn('total_harga', function($detail_orders){
            return $detail_orders->harga * $detail_orders->qty;
        })
        ->addColumn('harga_qty', function($detail_orders){
            return $detail_orders->harga.'('.$detail_orders->qty.')';
        })
        ->addColumn('filter', function($detail_orders){
            if ($detail_orders->keterangan == 1) {
                return 'makanan';
            }
            if ($detail_orders->keterangan == 2) {
                return 'minuman';
            }
        })
        ->editColumn('image', function($detail_orders){
            if ($detail_orders->image == '-') {
                if ($detail_orders->keterangan == 1) {
                    return 'masakan.png';
                }
                if ($detail_orders->keterangan == 2) {
                    return 'minuman.png';
                }
            }
            else{
                return $detail_orders->image;                
            }
        })
        ->editColumn('status', function($detail_orders){
            if ($detail_orders->status == 1) {
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
    
    // Order Add
    public function order_add(Request $request, $id){
        $detailOrder = new Detail_Order;
        $detailOrder->id_masakan = $id;
        $detailOrder->ip_user = "".request()->ip();
        $detailOrder->qty = $request->qty;
        $status = $detailOrder->save();
        if ($status) {
            return redirect('/order')->with('success','Pesanan Berhasil <a href="#">Ditambahkan</a>');
        }else
        {
            return redirect()->back()->with('error', 'Pesanan Gagal Ditambahkan');
        }
    }

    // Order Edit
    public function order_edit(Request $request, $id){
        $detailOrder = Detail_Order::where('ip_user', request()->ip())->where('status', 1)->where('id_masakan', $id)->get()->first();
        $detailOrder->qty = $request->qty;
        $status = $detailOrder->save();
        if ($status) {
            return redirect('/order/myorder')->with('success','Pesanan Berhasil <a href="#">Diubah</a>');
        }else
        {
            return redirect()->back()->with('error', 'Pesanan Gagal Diubah');
        }   
    }

    // Order Delete
    public function order_delete(Request $request){
        $output = 'Error';
        $detail_orders = Detail_Order::where('id',$request->get('id'))->first();
        if($detail_orders->delete()){
            $output = 'Success';
         }

        echo json_encode($output);
    }

    // Order Send
    public function order_send(Request $request){
        $order = new Order;
        $order->id_meja = $request->id_meja;
        $order->atas_nama = $request->atas_nama;
        $order->ip_user = request()->ip();
        $status = $order->save();
        if ($status) {
            if ($status) {
                $edit = Detail_Order::where('ip_user', request()->ip())->where('status', 1)->get('id');
                foreach ($edit as $clear) {
                    $update = Detail_Order::where('id', $clear->id)->first();
                    $update->status = 2;
                    $update->id_order = $order->id;
                    $update->update();
                }
                return redirect('order')->with('success','<i class="fa fa-check"></i> Pesanan Berhasil <a href="#">Dikirim</a><br><br>No. pesanan anda '.$order->id);
            }
        }else
        {
            return redirect()->back()->with('error', 'Pesanan Gagal Ditambahkan');
        }
    }


}
