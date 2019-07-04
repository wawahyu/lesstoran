@extends('admin.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
                    <div class="row margint90">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li>Pembayaran</li>
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
                            
                                    <li class="active">
                                        <a href="{{url('admin/transaction')}}"><span class="fa fa-list"></span> Terbaru</a>           
                                    </li>
                                    
                                </ul>
                                <div class="tab-content ">
<table class="table table-btransactioned" id="transaction-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pembeli</th>
                            <th>No Meja</th>
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
                                    @if (@$filter)
                                    <div class="col-md-6">
                                        <div class="box">
                                            <a href="{{ url('admin/transaction')}}/{{@$filter}}/add" class="btn btn-success btn-block"><i class="fa fa-plus-circle"></i> Tambah Data</a>
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
<div id="submitModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="submit_form">
                <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal_title">Submit Data</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <p style="color: red; font-size: 12px">\*Data yang sudah disubmit tidak bisa dikembalikan lagi</p>
                    
                <div class="modal-footer">
                    <input type="hidden" name="id" id="submit_id" value="" />
                    <button type="submit" name="submit" id="submit_action" value="add" class="btn btn-info"> Submit </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Tutup </button>
                </div>
            </form>
                </div>
        </div>
    </div>
</div>
<div id="successSubmitModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal_title">Keterangan</h4>
                </div>
                <div class="modal-body alert alert-success fade-in">
                    Data Berhasil Disubmit
                </div>
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Tutup </button>
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
    <form action="{{url('admin/transaction/list')}}/@{{id}}/update" method="post">
    {{csrf_field()}}
    <table class="table">
        <tr>
            <td width="33%">Nama Pembeli</td>
            <td><center>:</center></td>
            <td width="33%">@{{nama_user}}</td>
        </tr>
        <tr>
            <td>No Meja</td>
            <td><center>:</center></td>
            <td>@{{nama_meja}}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td><center>:</center></td>
            <td>@{{status}}</td>
        </tr>
        <tr>
            <td>Pesanan(Jumlah)</td>
            <td><center>:</center></td>
            <td>@{{daftar}}</td>
        </tr>
        <tr>
            <td>Total Harga</td>
            <td><center>:</center></td>
            <td>@{{total_harga}}</td>
        </tr>
        <tr>
            <td>
                Masukkan Uang
            </td>
            <td>
                <center>:</center>
            </td>
            <td>
                <input type="number" name="total_bayar" required="required">
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><button type="submit" class="btn btn-block btn-success">Selesai</button></td>
        </tr>
    </table>
    </form>
</script>

<script type="text/javascript">
$(document).ready(function(){
    var layouts = Handlebars.compile($("#details-layouts").html());
    

    var table = $('#transaction-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('admin/transaction/list/datatables')}}",
        columns: [
            {data: 'rownum', name: 'rownum',transactionable: false, searchable: false, width: '3%'},
            {data: 'nama_user', name: 'nama_user', width: '40%'},
            {data: 'nama_meja', name: 'nama_meja', width: '30%'},
            {
                "className":      'details-control',
                "transactionable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": '',
                "width": '5%',
            },
        ],
        transaction: [[0, 'asc']]
    });

    $(document).on('click', '.refresh', function(){
        $('#transaction-table').DataTable().ajax.reload();
    });

    $(document).on('click', '.submit', function(){
        var id = $(this).attr("transaction-id");
        $('#form_output').html('');
        $('#submitModal').modal('show');
        $('#submit_id').val(id);
    });


    $('#submit_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        var id = $(this).attr('submit_id');
        $.ajax({
                url:"{{url('admin/transaction/update')}}",
                mehtod:"post",
                data:{id:id},
                data:form_data,
                dataType:'json',
                success:function(data)
                {
                    $('#submitModal').modal('hide');
                    $('#successSubmitModal').modal('show');
                    $('#transaction-table').DataTable().ajax.reload();
                    $('#form_output').html(data);
                    
                }
            })
    });
        

    $('#transaction-table tbody').on('click', 'td.details-control', function () {
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