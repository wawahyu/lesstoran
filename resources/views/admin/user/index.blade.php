@extends('admin.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
                    <div class="row margint90">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="{{url('admin/user/')}}">User</a></li>
                            <li class="active">@if(@$filter) {{$filter}} @else List @endif</li>
                        </ul>
  
                        <div class="col-xs-12 col-sm-8 col-md-8 padt10 panel-medidu">
                    
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
                            
                                    <li @if (!@$filter) class="active" @endif>
                                        <a href="{{url('admin/user')}}"><span class="fa fa-list"></span> List</a>           
                                    </li>
                                    <li @if (@$filter == 'pelanggan') class="active" @endif>
                                        <a href="{{url('admin/user/filter/pelanggan')}}"><span class="fa fa-user"></span> Pelanggan</a>            
                                    </li> 
                                    <li @if (@$filter == 'pegawai') class="active" @endif>
                                        <a href="{{url('admin/user/filter/pegawai')}}"><span class="fa fa-black-tie"></span> Pegawai</a>           
                                    </li>
                                    <li @if (@$filter == 'pemilik') class="active" @endif>
                                        <a href="{{url('admin/user/filter/pemilik')}}"><span class="fa fa-black-tie"></span> Pemilik</a>           
                                    </li>
                                    <li @if (@$filter == 'resign') class="active" @endif>
                                        <a href="{{url('admin/user/filter/resign')}}"><span class="fa fa-black-tie"></span> Resign</a>           
                                    </li>
                                </ul>
                                <div class="tab-content ">
<table class="table table-bordered" id="user-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
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
                                    @if(@$filter)
                                    <div class="col-md-6">
                                        <div class="box">
                                            <a href="{{ url('admin/user/')}}/{{$filter}}/add" class="btn btn-success btn-block"><i class="fa fa-plus-circle"></i> Tambah Data</a>
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
                    Yakin Hapus Data User ini ?
                    
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
                    <input type="hidden" name="id" id="hapus_id" value="" />
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
    <table class="table">
        <tr>
            <td width="33%">Nama</td>
            <td><center>:</center></td>
            <td width="33%">@{{nama}}</td>
        </tr>
        <tr>
            <td>Username</td>
            <td><center>:</center></td>
            <td>@{{username}}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td><center>:</center></td>
            <td>@{{email}}</td>
        </tr>
        <tr>
            <td>Level</td>
            <td><center>:</center></td>
            <td>@{{role_name}}</td>
        </tr>
        <tr>
            <td>Active</td>
            <td><center>:</center></td>
            <td>@{{active}} @if(@$filter == 'resign') <a href="{{url('admin/user/resign/back')}}/@{{id}}" class="btn btn-warning"> Kembalikan </a> @endif </td>
        </tr>
        <tr>
            <td>
                Aksi
            </td>
            <td>
                <a href="{{url('admin/user')}}/@{{filter}}/@{{id}}/edit" user-id="@{{id}}" name="@{{name}}" class="btn btn-block btn-primary edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            </td>
            <td>
                <a href="#" user-id="@{{id}}" class="btn btn-block btn-danger delete"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
            </td>
        </tr>
    </table>
</script>

<script type="text/javascript">
$(document).ready(function(){
    var layouts = Handlebars.compile($("#details-layouts").html());
    
    
    var table = $('#user-table').DataTable({
        processing: true,
        serverSide: true,
        @if (@$filter)
        ajax: "{{ url('admin/user/datatables/filter') }}/{{$filter}}",
        @else
        ajax: "{{ url('admin/user/datatables') }}",
        @endif
        columns: [
            {
                "className":      'details-control',
                "orderable":      false,
                "searchable":     false,
                "data":           null,
                "defaultContent": '',
                "width": '5%',
            },
            {data: 'rownum', name: 'rownum',orderable: false, searchable: false, width: '6%'},
            {data: 'nama', name: 'nama', width: '50%'},
            {data: 'email', name: 'email', width: '30%'},
        ],
        order: [[1, 'asc']]
    });

    $(document).on('click', '.refresh', function(){
        $('#user-table').DataTable().ajax.reload();
    });

    
    $(document).on('click', '.delete', function(){
        var id = $(this).attr("user-id");
        $('#form_output').html('');
        $('#hapusModal').modal('show');
        $('#hapus_id').val(id);
    });

    
    $('#hapus_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        var id = $(this).attr('hapus_id');
        $.ajax({
                url:"{{url('admin/user/delete')}}",
                mehtod:"post",
                data:{id:id},
                data:form_data,
                dataType:'json',
                success:function(data)
                {
                    $('#hapusModal').modal('hide');
                    $('#user-table').DataTable().ajax.reload();
                    $('#form_output').html(data);
                    $('#successHapusModal').modal('show');
                    
                }
            })
    });
        
    
    $('#user-table tbody').on('click', 'td.details-control', function () {
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