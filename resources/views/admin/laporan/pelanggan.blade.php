@extends('admin.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
    <div class="row margint90">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Laporan</a></li>
            <li class="active">{{$title}}</li>
        </ul>
        <div class="col-xs-12 col-sm-12 col-md-12 padt10 panel-medidu">    
            <div class="media col-md-12">                                
                <div class="media-body col-md-4">
                    <h3 class="media-heading"><span class="fa fa-coffee"></span> <a href="#">{{$title}}</a></h3>
                    <p></p>
                    <hr style="margin:8px auto;height:1px;">
                </div>
                @if(session('error'))
                <div class="alert alert-danger fade in col-md-6">
                    <button type="button" class="close pull-right" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {!! session('error') !!}
                </div>
                @endif
            </div>    
            <div>    
                <ul class="nav nav-tabs">            
                    <li>
						<a href="{{url('admin/laporan/filter/masakan')}}"><span class="fa fa-coffee"></span> Masakan</a>           
					<li  class="active">
						<a href="{{url('admin/laporan/filter/pelanggan')}}"><span class="fa fa-user"></span> Pelanggan</a>            
					</li> 
					<li>
						<a href="{{url('admin/laporan/filter/pesanan')}}"><span class="fa fa-clipboard"></span> Pesanan</a>           
					</li>  
					<li>
						<a href="{{url('admin/laporan/filter/transaksi')}}"><span class="fa fa-money"></span> Transaksi</a>           
					</li>
                </ul>
                <div class="tab-content ">
					<table class="table table-bordered" id="user-table">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Jumlah Pemesanan</th>
								<th>Jumlah Transaksi</th>
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
    
    var table = $('#user-table').DataTable({
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        buttons: [
                'print',
                'excelHtml5',
                'pdfHtml5', 
            ],
        ajax: "{{ url('admin/user/datatables/filter/pelanggan') }}",
        columns: [
            {data: 'rownum', name: 'rownum',orderable: false, searchable: false, width: '6%'},
            {data: 'nama', name: 'nama', width: '30%'},
            {data: 'email', name: 'email', width: '35%'},
            {data: 'jumlah_pemesanan', name: 'jumlah_pemesanan', width: '15%'},
            {data: 'jumlah_transaksi', name: 'jumlah_transaksi', width: '15%'},
        ],
        order: [[1, 'asc']]
    });

    $(document).on('click', '.refresh', function(){
        $('#user-table').DataTable().ajax.reload();
    });

})
</script>

@endsection