@extends('waiter.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
    <div class="row margint90">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Pengguna</a></li>
            <li>Ubah Password</li>
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
					
					<div class="box-body">
						<form id="form-user" action="{{ url('waiter/myaccount/password/edit') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}
			
							<div class="col-md-12">
								<div class="form-group">
									<label>Password Baru</label>
									<input type="password" name="newpassword" class="form-control" placeholder="Password Baru" required="required">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label>Password Baru</label>
									<input type="password" name="confirmpassword" class="form-control" placeholder="Password Baru" required="required">
								</div>
							</div>
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