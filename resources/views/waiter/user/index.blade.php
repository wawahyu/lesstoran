@extends('waiter.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
                    <div class="row margint90">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="{{url('waiter/user/')}}">User</a></li>
                            <li class="active">@if(@$filter) {{ucfirst($filter)}} @else List @endif</li>
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
                                        <a href="{{url('waiter/user')}}"><span class="fa fa-list"></span> List</a>           
                                    </li>
                                    <li @if (@$filter == 'pelanggan') class="active" @endif>
                                        <a href="{{url('waiter/user/filter/pelanggan')}}"><span class="fa fa-user"></span> Pelanggan</a>            
                                    </li> 
                                    <li @if (@$filter == 'pegawai') class="active" @endif>
                                        <a href="{{url('waiter/user/filter/pegawai')}}"><span class="fa fa-black-tie"></span> Pegawai</a>           
                                    </li>
                                    <li @if (@$filter == 'pemilik') class="active" @endif>
                                        <a href="{{url('waiter/user/filter/pemilik')}}"><span class="fa fa-black-tie"></span> Pemilik</a>           
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
                                    @if(@$filter == 'pelanggan')
                                    <div class="col-md-6">
                                        <div class="box">
                                            <a href="{{ url('waiter/user/')}}/{{$filter}}/add" class="btn btn-success btn-block"><i class="fa fa-plus-circle"></i> Tambah Data</a>
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
            <td>@{{active}}</td>
        </tr>
        <tr>
            <td>
                Aksi
            </td>
            <td>
                
            </td>
            <td>
                <a href="{{url('waiter/user')}}/@{{filter}}/@{{id}}/edit" user-id="@{{id}}" name="@{{name}}" class="btn btn-block btn-primary edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
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
        ajax: "{{ url('waiter/user/datatables/filter') }}/{{$filter}}",
        @else
        ajax: "{{ url('waiter/user/datatables') }}",
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