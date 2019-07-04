@extends('admin.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
                    <div class="row margint90">
                        <ul class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Pengguna</a></li>
                            <li><a href="{{url('admin/user/filter')}}/{{$filter}}">{{ucfirst($filter)}}</a></li>
                            <li class="active">@if(@$data) Edit @else Tambah @endif</li>
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
                                <div class="box"> 
            <div class="box-header with-border">
                <a href="{{ url('admin/user/filter')}}/{{@$filter}}" class="btn bg-purple"><i class="fa fa-chevron-left"></i> Kembali</a>
            </div>
            <div class="box-body">
                <form id="form-user" action="{{ empty($data) ? url('admin/user/store') : url("admin/user/$data->id/update") }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if (!empty($result))
                    {{ method_field('patch') }}
                @endif


                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ @$data->name }}" required="required">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ @$data->username }}" required="required">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ @$data->email }}" required="required">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="email" name="password" class="form-control" placeholder="Password" value="" disabled="disabled">
                        <a href="#" style="color: red; font-size: 12px">*/ Password default otomatis menyesuaikan username</a>
                    </div>
                </div>
                @if (@$data)
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Reset password</label>
                        <a href="{{url('admin/user/')}}/{{$filter}}/{{$data->id}}/reset" class="btn btn-danger">Reset Password</a>
                    </div>
                </div>
                @endif

                @if ($id == 1)
                    <input type="text" name="id_role" value="4" hidden="hidden">
                @endif
                @if ($id == 2)
                    <input type="text" name="id_role" value="5" hidden="hidden">
                @endif
                @if ($id == 3)
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control select2" name="id_role" style="width: 100%;" required="required">
                                <option value=""></option>
                                @foreach (\App\Models\Role::get()->where('id', '!=', 4)->where('id', '!=', 5) as $role)
                                <option value="{{ $role->id }}" 
                                    @if ($role->id == @$data->id_role)
                                        selected
                                    @endif
                                >{{ $role->nama }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>                    
                @endif
            </div>
            
        </div>   
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-8 padt10 col-xs-12">
            
                            <div class="panel panel-medidu">
                                <div class="panel-heading"><h3>Aksi</h3></div>
                                <div class="panel-body">
                <div class="col-md-6">
                    <div class="box">
                        <button type="reset" onclick="Reset()" class="btn btn-danger btn-block"><i class="fa  fa-times"></i> Reset</button>
                    </div>
                </div>
                                    <div class="col-md-6">
                    <div class="box">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
        
                <script type="text/javascript">
                    function Reset() {
                        document.getElementById("form-user").reset();
                    }
                </script>

                </form>
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



@endsection