@extends('guest.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
                    <div class="row margint90">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="{{url('order/')}}">Menu</a></li>
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
                                        <a href="{{url('order')}}"><span class="fa fa-list"></span> List</a>           
                                    </li>
                                    <li @if (@$filter == 'makanan') class="active" @endif>
                                        <a href="{{url('order/filter/makanan')}}"><span class="glyphicon glyphicon-cutlery"></span> Makanan</a>            
                                    </li> 
                                    <li @if (@$filter == 'minuman') class="active" @endif>
                                        <a href="{{url('order/filter/minuman')}}"><span class="glyphicon glyphicon-glass"></span> Minuman</a>           
                                    </li>            
                                </ul>
                                <div class="tab-content ">
<table class="table table-bordered" id="order-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Pesan</th>
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
                                    @if (@$filter)
                                    <div class="col-md-6">
                                        <div class="box">
                                            <a href="{{ url('order')}}/{{@$filter}}/add" class="btn btn-success btn-block"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                                        </div>
                                    </div>
                                    @endif
                                    <script type="text/javascript">
                                    function ReloadBTN(){
                                        location.reload();
                                    }
                                    </script>
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
    <form id="form-order" action="{{ url('order') }}/@{{id}}/add" class="form-horizontal" method="POST" enctype="multipart/form-data">
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
                :
            </td>
            <td>
                
                <input type="number" name="qty" required="required" value="1" required="required">
                
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="submit" class="btn btn-info btn-block"><i class="fa fa-cart-plus"></i> Tambahkan</button>
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
        ajax: "{{ url('order/datatables')}}",
        @else
        ajax: "{{ url('order/datatables/filter') }}/{{$filter}}",
        @endif
        columns: [
            {data: 'rownum', name: 'rownum',orderable: false, searchable: false, width: '3%'},
            {data: 'nama', name: 'nama', width: '40%'},
            {data: 'harga', name: 'harga', width: '30%'},
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
                url:"{{url('order/delete')}}",
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