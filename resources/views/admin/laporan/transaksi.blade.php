@extends('admin.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
    <div class="row margint90">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="{{url('admin/transaction/')}}">Menu</a></li>
            <li class="active">@if(@$filter) {{ucfirst($filter)}} @else Masakan & Minuman @endif</li>
        </ul>
        <div class="col-xs-12 col-sm-12 col-md-12 padt10 panel-medidu">
            <div class="media">                
                <div class="media-body">
                    <h3 class="media-heading"><span class="fa fa-coffee"></span> <a href="#">{{$title}}</a></h3>
                    <p></p>
                    <hr style="margin:8px auto;height:1px;">
                </div>
            </div>    
            <div>    
                <ul class="nav nav-tabs">
                    <li>
						<a href="{{url('admin/laporan/filter/masakan')}}"><span class="fa fa-coffee"></span> Masakan</a>           
					</li>
					<li>
						<a href="{{url('admin/laporan/filter/pelanggan')}}"><span class="fa fa-user"></span> Pelanggan</a>            
					</li> 
					<li>
						<a href="{{url('admin/laporan/filter/pesanan')}}"><span class="fa fa-clipboard"></span> Pesanan</a>           
					</li>  
					<li  class="active">
						<a href="{{url('admin/laporan/filter/transaksi')}}"><span class="fa fa-money"></span> Transaksi</a>           
					</li>
                </ul>
                <div class="tab-content ">
					<table class="table table-btransactioned" id="transaction-table">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama Pembeli</th>
								<th>Total Harga</th>
								<th>Total Bayar</th>
								<th>Tanggal Transaksi</th>
							</tr>
						</thead>
					</table>                            
				</div>
			</div>
		</div>
    </div>
</div>
@endsection

@section('scripts')

<script src="{{asset('js')}}/jquery.dataTables.min.js"></script>
<script src="{{asset('js')}}/datatables.bootstrap.js"></script>
<script src="{{asset('js')}}/handlebars.js"></script>
<script src="{{asset('jszip')}}/dist/jszip.min.js"></script>
<script src="{{asset('pdfmake')}}/build/pdfmake.min.js"></script>
<script src="{{asset('pdfmake')}}/build/vfs_fonts.js"></script>
<link rel="stylesheet" href="{{asset('node')}}/datatables.net-buttons-dt/css/buttons.dataTables.css">
<script src="{{asset('node')}}/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('node')}}/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('node')}}/datatables.net-buttons/js/buttons.html5.min.js"></script>


<script type="text/javascript">
$(document).ready(function(){
    
    var table = $('#transaction-table').DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        buttons: [
                'print',
                'excelHtml5',
                'pdfHtml5', 
            ],
        ajax: "{{ url('admin/list/transaction/datatables')}}",
        columns: [
            {data: 'rownum', name: 'rownum', orderable: false, searchable: false, width: '3%'},
            {data: 'nama', name: 'nama', width: '25%'},
            {data: 'total_harga', name: 'total_harga', width: '20%'},
            {data: 'total_bayar', name: 'total_bayar', width: '20%'},
            {data: 'tanggal', name: 'tanggal', width: '20%'},
            
        ],
        transaction: [[0, 'asc']]
    });

    $(document).on('click', '.refresh', function(){
        $('#transaction-table').DataTable().ajax.reload();
    });

    })
</script>

@endsection