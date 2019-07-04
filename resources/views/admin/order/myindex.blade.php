@extends('admin.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
                    <div class="row margint90">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="{{url('admin/order/')}}">Pesanan</a></li>
                            <li class="active">@if(@$filter) {{ucfirst($filter)}} @else Masakan & Minuman @endif</li>
                        </ul>
  
                        <div class="col-xs-12 col-sm-8 col-md-8 padt10 panel-medidu">
                    
                            <div class="media">
                                
                                <div class="media-body">
                                    <h3 class="media-heading"><span class="fa fa-coffee"></span> <a href="#">{{$title}}</a></h3>
                                    <p></p>
                                    <hr style="margin:8px auto;height:1px;">
                                </div>
                            </div>    
                            <div>
                
                                <ul class="nav nav-tabs">
                            
                                    <li @if (!@$filter) class="active" @endif>
                                        <a href="{{url('admin/order/myorder')}}"><span class="fa fa-list"></span> List</a>           
                                    </li>
                                    <li @if (@$filter == 'makanan') class="active" @endif>
                                        <a href="{{url('admin/order/myorder/filter/makanan')}}"><span class="glyphicon glyphicon-cutlery"></span> Makanan</a>            
                                    </li> 
                                    <li @if (@$filter == 'minuman') class="active" @endif>
                                        <a href="{{url('admin/order/myorder/filter/minuman')}}"><span class="glyphicon glyphicon-glass"></span> Minuman</a>           
                                    </li>            
                                </ul>
                                <div class="tab-content ">
<table class="table table-bordered" id="order-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga(Jumlah)</th>
                            <th>Total</th>
                            <th>Lihat</th>
                        </tr>
                    </thead>
                </table>
                            
                                </div>
                
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-8 padt10 col-xs-12">
            
                            <div class="panel panel-medidu">
                                <div class="panel-heading"><h3>Aksi</h3></div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="box">
                                            <a href="#" class="btn btn-info btn-block refresh" ondblclick="ReloadBTN()"><i class="fa fa-refresh"></i> Refresh </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box">
                                            <a href="{{ url('admin/order')}}" class="btn btn-success btn-block"><i class="fa fa-plus-circle"></i> Tambah</a>
                                        </div>
                                    </div>

                                    <script type="text/javascript">
                                    function ReloadBTN(){
                                        location.reload();
                                    }
                                    </script>
                                </div>
                                @if (!@$filter && Auth::user()->myOrderCount()>0)
                                <div class="panel-footer">
                                    <div class="col-md-12">
                                        <div class="box">
                                            <a href="#" data-target="#alertSendModal" data-toggle="modal" class="btn btn-success btn-block"><i class="fa fa-sign-in"></i> Kirim Pesanan</a>
                                        </div>
                                    </div>                                    
                                </div>
                                @endif
                            </div>
            
                        </div>

    
                    </div>
                </div>

<div id="alertSendModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{url('admin/order/send')}}">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal_title">Kirim Pesanan</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label>Pilih Meja Anda</label>
                            <select class="form-control select2" name="id_meja" style="width: 100%;" required="required">
                                <option value=""></option>
                                @foreach (\App\Models\Meja::all() as $meja)
                                <option value="{{ $meja->id }}" 
                                    
                                >{{ $meja->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                    
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-info"> Kirim </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Tutup </button>
                </div>
            </form>
                </div>
        </div>
    </div>
</div>

<div id="hapusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="hapus_form">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal_title">Hapus Data</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    Yakin Hapus Data Pesanan ini ?
                    
                <div class="modal-footer">
                    <input type="hidden" name="id" id="hapus_id" value="" />
                    <button type="submit" name="submit" id="hapus_action" value="add" class="btn btn-info"> Hapus </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Tutup </button>
                </div>
            </form>
                </div>
        </div>
    </div>
</div>
<div id="successHapusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal_title">Keterangan</h4>
                </div>
                <div class="modal-body alert alert-success fade-in">
                    Data Berhasil Dihapus
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="ReloadBTN()"> Tutup </button>
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

<script id="details-layouts" type="text/x-handlebars-layouts">
    <form id="form-order" action="{{ url('admin/order') }}/@{{id_masakan}}/edit" class="form-horizontal" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <table class="table">
        <tr>
            <td>Gambar</td>
            <td><center>:</center></td>
            <td><img src="{{asset('masakan_image/')}}/@{{image}}" width="100px" height="100px"></td>
        </tr>
        <tr>
            <td width="33%">Nama</td>
            <td><center>:</center></td>
            <td width="33%">@{{nama}}</td>
        </tr>
        <tr>
            <td>Harga</td>
            <td><center>:</center></td>
            <td>@{{harga}}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td><center>:</center></td>
            <td>@{{keterangan}}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td><center>:</center></td>
            <td>@{{status}}</td>
        </tr>
        <tr>
            <td>
                Total pesanan
            </td>
            <td>
                <center>:</center>
            </td>
            <td>
                
                <input type="number" name="qty" required="required" value="@{{qty}}" required="required">
                
            </td>
        </tr>
        <tr>
            <td>
                <a href="#" order-id="@{{id}}" class="btn btn-block btn-danger delete"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
            </td>
            <td>
                
            </td>
            <td>
                <button type="submit" class="btn btn-info btn-block"><i class="fa fa-cart-plus"></i> Ubah</button>
            </td>
        </tr>
    </table>
    </form>

</script>

<script type="text/javascript">
$(document).ready(function(){
    var layouts = Handlebars.compile($("#details-layouts").html());
    
    var table = $('#order-table').DataTable({
        processing: true,
        serverSide: true,
        @if(!@$filter)
        ajax: "{{ url('admin/order/myorder/datatables')}}",
        @else
        ajax: "{{ url('admin/order/myorder/datatables/filter') }}/{{$filter}}",
        @endif
        columns: [
            {data: 'rownum', name: 'rownum',orderable: false, searchable: false, width: '3%'},
            {data: 'nama', name: 'nama', width: '40%'},
            {data: 'harga_qty', name: 'harga_qty', orderable: false, searchable: false, width: '30%'},
            {data: 'total_harga', name: 'total_harga', orderable: false, searchable: false, width: '30%'},
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": '',
                "width": '5%',
            },
        ],
        order: [[0, 'asc']]
    });

    $(document).on('click', '.refresh', function(){
        $('#order-table').DataTable().ajax.reload();
    });

    $(document).on('click', '.delete', function(){
        var id = $(this).attr("order-id");
        $('#form_output').html('');
        $('#hapusModal').modal('show');
        $('#hapus_id').val(id);
    });

    $('#hapus_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        var id = $(this).attr('hapus_id');
        $.ajax({
                url:"{{url('admin/order/delete')}}",
                mehtod:"post",
                data:{id:id},
                data:form_data,
                dataType:'json',
                success:function(data)
                {
                    $('#hapusModal').modal('hide');
                    $('#successHapusModal').modal('show');
                    $('#order-table').DataTable().ajax.reload();
                    $('#form_output').html(data);
                    
                }
            })
    });
        
    $('#order-table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            
            row.child( layouts(row.data()) ).show();
            tr.addClass('shown');
        }
    });

    })
</script>

@endsection