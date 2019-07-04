<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Masakan;
use App\Models\Detail_Order;

use DB;
use DataTables;
use File;

class MasakanController extends Controller
{
    // Masakan Index
    public function masakan_index(){
        $title = 'Menu';
        return view('admin.masakan.index', compact('title'));
    }

    public function masakan_filter($filter){
        if ($filter == 'makanan' || $filter == 'minuman' || $filter == 'habis'|| $filter == 'tersedia') {
            # code...
            $title = 'Daftar '.ucfirst($filter);
            return view('admin.masakan.index', compact('title', 'filter'));
        }
        else{
            return redirect('admin/masakan');
        }
    }

    // Masakan Datatables
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

    public function masakan_filter_datatables($filter){
        if ($filter == 'makanan') {
            $filter = 1;
        }
        else if ($filter == 'minuman') {
            $filter = 2;
        }
        else if ($filter == 'habis') {
            $filter = 3;
        }
        else if ($filter == 'tersedia') {
            $filter = 4;
        }
        else{
            return redirect('admin/masakan');
        }
        if ($filter <=2) {
            $where = 'keterangan';
        }else{
            $where = 'status';
            if ($filter == 3) {
                $filter =2;
            }
            else{
                $filter =1;
            }
            
        }
        DB::statement(DB::raw('set @rownum=0'));
        $masakan = Masakan::where($where, $filter)
        ->select([
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

    // Masakan Add
    public function masakan_add($filter){
        if ($filter == 'makanan' || $filter == 'minuman') {
            $title = 'Tambah '.ucfirst($filter);
            if ($filter == 'makanan') {
                $id = 1;
            }
            if ($filter == 'minuman') {
                $id = 2;
            }
        return view('admin.masakan.form', compact('title', 'id', 'filter'));
        }
        else{
            return redirect('admin/masakan');
        }
    }

    public function masakan_store(Request $request){
        $image = $request->file('file');
        if ($image != null) {
            $name = $image->getClientOriginalName();
            $type = $image->getClientMimeType();
            $filename = $request->nama.$name;
            $location = 'masakan_image';
            $image->move(
                $location,
                $filename
            );
            $namaimage = $filename;
            
        }
        else
        {
            $namaimage = '-';
        }
        
        $masakan = new Masakan;
        $masakan->nama = $request->nama;
        $masakan->harga = $request->harga;
        $masakan->keterangan = $request->keterangan;
        $masakan->status = $request->status;
        $masakan->image = $namaimage;
        $status = $masakan->save();
    

        if ($status) {
            if ($request->keterangan == 1) {
                return redirect('admin/masakan/filter/makanan')->with('success','Data Berhasil <a href="#">Ditambahkan</a>');
            }
            else if ($request->keterangan == 2) {
                return redirect('admin/masakan/filter/minuman')->with('success','Data Berhasil <a href="#">Ditambahkan</a>');
            }
        }else
        {
            return redirect()->back()->with('error', 'Data Gagal Ditambahkan');
        }
    }

    // Masakan Edit
    public function masakan_edit($filter, $id){
        if ($filter == 'makanan' || $filter == 'minuman') {
            $title = 'Edit '.ucfirst($filter);
            $data = Masakan::where('id', $id)->first();
            if ($filter == 'makanan') {
                $id = 1;
            }
            if ($filter == 'minuman') {
                $id = 2;
            }
            return view('admin.masakan.form', compact('title', 'id', 'filter', 'data'));
        }
        else{
            return redirect('admin/masakan');
        }
        $title = 'Edit Data Masakan';
        $data = Masakan::where('id', $id)->first();
        return view('admin.masakan.form',compact('data','title'));        
    }

    public function masakan_update(Request $request, $id){
        $image = $request->file('file');
        if ($image) {
            $masakan = Masakan::where('id',$id)->first();
            if ($masakan->image != '-') {
                File::delete('masakan_image/'.$masakan->image);
            }
            $name = $image->getClientOriginalName();
            $type = $image->getClientMimeType();
            $filename = $request->nama.$name;
            $location = 'masakan_image';
            $image->move(
                $location,
                $filename
            );

            $namaimage = $filename;
            $masakan = Masakan::where('id',$id)->first();
            $masakan->nama = $request->nama;
            $masakan->harga = $request->harga;
            $masakan->status = $request->status;
            $masakan->keterangan = $request->keterangan;
            $masakan->image = $filename;
            $status = $masakan->update();
        }
        else
        {
            $masakan = Masakan::where('id',$id)->first();
            $masakan->nama = $request->nama;
            $masakan->harga = $request->harga;
            $masakan->status = $request->status;
            $masakan->keterangan = $request->keterangan;
            $status = $masakan->update();
        }


        if ($status) {
            if ($request->keterangan == 1) {
                return redirect('admin/masakan/filter/makanan')->with('success','Data Berhasil <a href="#">Diubah</a>');
            }
            else if ($request->keterangan == 2) {
                return redirect('admin/masakan/filter/minuman')->with('success','Data Berhasil <a href="#">Diubah</a>');
            }
        }else
        {
            return redirect()->back()->with('error', 'Data Gagal Diubah');
        }
    }

    // Masakan Delete
    public function masakan_delete(Request $request){
        $output = 'Error';
        $data = Detail_Order::where('id_masakan', $request->get('id'))->get();
        $masakan = Masakan::where('id',$request->get('id'))->first();
        if ($data) {
            $masakan->status = 2;
            if ($masakan->update()) {
                $output = 'Success';
            }
        }
        else{
            if ($masakan->image != '-') {
            File::delete('masakan_image/'.$masakan->image);
            }
            if($masakan->delete()){
                $output = 'Success';
            }
        }

        echo json_encode($output);
    }
}
