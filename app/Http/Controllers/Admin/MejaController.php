<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Meja;

use DB;
use DataTables;

class MejaController extends Controller
{
    // Meja Index
    public function meja_index(){
        $title = 'Meja';
        return view('admin.meja.index', compact('title'));
    }

    // Meja Datatables
    public function meja_datatables(){
        DB::statement(DB::raw('set @rownum=0'));
        $meja = Meja::select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'nama'
        ]);

        $datatables = DataTables::of($meja);

        return $datatables->make(true);
    }

    // Meja Add
    public function meja_add(){
        $title = 'Tambah Meja';
        return view('admin.meja.form', compact('title'));
    }

    public function meja_store(Request $request){
        $meja = new Meja;
        $meja->nama = $request->nama;
        $status = $meja->save();
        if ($status) {
            return redirect('admin/meja')->with('success','Data Berhasil <a href="#">Ditambahkan</a>');
        }else
        {
            return redirect('admin/meja/add')->with('error', 'Data Gagal Ditambahkan');
        }
    }

    // Meja Edit
    public function meja_edit($id){
        $title = 'Edit Meja';
        $data = Meja::where('id', $id)->first();
        return view('admin.meja.form', compact('title', 'data'));
    }

    public function meja_update(Request $request, $id){
        $meja = Meja::where('id', $id)->first();
        $meja->nama = $request->nama;
        $status = $meja->update();

        if ($status) {
            return redirect('admin/meja')->with('success','Data Berhasil <a href="#">Diubah</a>');
        }else
        {
            return redirect()->back()->with('error', 'Data Gagal Diubah');
        }
    }

    // Meja Delete
    public function meja_delete(Request $request){
        $output = '<div class="alert alert-danger fade in" id="div-alert">
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            Data Gagal Dihapus';
        $meja = Meja::where('id',$request->get('id'))->first();
        if($meja->delete()){
            $output = '<div class="alert alert-success fade in" id="div-alert">
            <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            Data Berhasil Dihapus
            ';
         }

        echo json_encode($output);
    }
}
