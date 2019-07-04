<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Transaksi;

use DB;
use DataTables;

class TransactionListController extends Controller
{
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
}
