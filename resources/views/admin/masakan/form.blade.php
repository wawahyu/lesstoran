@extends('admin.layouts.master')

@section('content')
<link href="{{asset('css')}}/dataTables.bootstrap.css" rel="stylesheet">
<div class="container">
    <div class="row margint90">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="{{url('admin/masakan/')}}">Menu</a></li>
            <li><a href="{{url('admin/masakan/filter')}}/{{@$filter}}">{{ucfirst(@$filter)}}</a></li>
            <li class="active"> @if(!@$data)Tambah @else Edit @endif</li>
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
						<a href="{{ url('admin/masakan')}}" class="btn bg-purple"><i class="fa fa-chevron-left"></i> Kembali</a>
					</div>
					<div class="box-body">
						<form id="form-masakan" action="{{ empty($data) ? url('admin/masakan/store') : url("admin/masakan/$data->id/update") }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						@if (!empty($result))
							{{ method_field('patch') }}
						@endif

							<div class="col-md-12">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ @$data->nama }}" required="required">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label>Harga</label>
									<input type="number" name="harga" class="form-control" placeholder="Harga" value="{{ @$data->harga }}" required="required">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label>Status</label>
									<select class="form-control select2" name="status" style="width: 100%;" required="required">
										<option value=""></option>
										<option value="1" 
											@if (@$data->status == 1)
												selected
											@endif
										>Tersedia</option>
										<option value="2" 
											@if (@$data->status == 2)
												selected
											@endif
										>Tidak Tersedia</option>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<div class="col-md-6">
									@if(@$data->image=='-' || !@$data->image)
										@if(@$id == 1)
									<img src="{{asset('masakan_image')}}/makanan.png" width="100px" height="100px">
										@endif
										@if(@$id == 2)
									<img src="{{asset('masakan_image')}}/minuman.png" width="100px" height="100px">
										@endif
									<label>Gambar Default</label>
									@endif
									@if(@$data->image!='-' && @$data->image)
									<img src="{{asset('masakan_image')}}/{{@$data->image}}" width="100px" height="100px">  <label>Gambar Sebelumnya</label>
									@endif
								</div>
								<div class="col-md-6">
									<div class="form-group"><br>
										@if(@$data->image=='-' || !@$data->image)
										<label>Tambah Gambar</label>
										@endif
										@if(@$data->image!='-' && @$data->image)
										<label>Ubah Gambar</label>
										@endif
										<input type="file" name="file" class="form-control" accept="Image/png, Image/jpeg">
									</div>
								</div>
							</div>
							@if (@$id == 1)
							<input type="text" name="keterangan" value="1" hidden="hidden">
							@endif
							@if (@$id == 2)
							<input type="text" name="keterangan" value="2" hidden="hidden">
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
							document.getElementById("form-masakan").reset();
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