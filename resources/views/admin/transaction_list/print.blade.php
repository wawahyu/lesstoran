<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body onload="print()">
<div align="center">
<table class="table-alas">
    <tr>
        <td class="border-top"><center>
        SMKN 4 Bandung<br>
        Jl. Kliningan No. 6 Buah Batu, Bandung<br>
        Telp. (022) 7303736<br>
        Lesstoran<br>
        by. Wahyu Wahyudin
        </center></td>
    </tr>
    <tr>
        <td class="border-top">
            <center>Lestoran</center>
        </td>
    </tr>
    <tr>
        <td class="border-top border-bottom">
            <table width="100%" cellspacing="3">
                @foreach (\App\Models\Detail_Order::where('id_order', $id)->leftJoin('masakans', 'detail_orders.id_masakan', 'masakans.id')->get(['detail_orders.qty as qty', 'masakans.nama as nama', 'masakans.harga as harga']) as $data)
                <tr>
                    <td width="25%">
                        
                    </td>
                    <td align="left" colspan="2">
                        {{$data->nama}}
                    </td>
                    
                </tr>
                <tr>
                    @if ($data->qty>1)
                    <td align="center" width="35%">
                        {{$data->qty}}   x
                    </td>
                    <td align="left" width="40%">
                        {{$data->harga}}   =
                    </td>
                    @else
                    <td width="35%"></td>
                    <td width="40%"></td>
                    @endif
                    <td align="left">
                        {{number_format($data->harga*$data->qty)}}
                    </td>
                </tr>
                @endforeach
            </table>
        </td>
    </tr>
    <tr>
        <td class="border-top" align="right">
        <font size="5">Total   {{number_format($total_harga)}}</font><br>
        <font size="2">Bayar   {{number_format($total_bayar)}}</font><br>
        <font size="4">Kembali   {{number_format($total_bayar-$total_harga)}}</font>
        </td>
    </tr>
    <tr>
        <td style="font-size: 12px">Pelanggan : {{$pelanggan}}</td>
    </tr>
    <tr>
        <td style="font-size: 14px" align="center">Barang Kena Pajak Sudah Termasuk PPN</td>
    </tr>
    <tr>
        <td align="center" style="font-size: 10px">
            {{Auth::user()->name}}/{{$id}}.No/{{$created_at}}
        </td>
    </tr>
    <tr>
        <td align="center" class="border-bottom">
            Terima Kasih
        </td>
    </tr>
</table>
</div>
<style type="text/css">
    body{
        width: 105mm;
    }
    table.alas{
        width: 100%;
    }
    tr{
        
    }
    td.border-top{
        border-top: 2px dashed black;
    }
    td.border-bottom{
        border-bottom: 2px dashed black;
    }
</style>
</body>
</html>
