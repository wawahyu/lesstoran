<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lesstoran | {{ $title }}</title>
	<link rel="shortcut icon" href="{{asset('images')}}/lesstoran.png">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="{{asset('bootstrap/dist/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">	
</head>
<body @if(session('success')) onload='success()' @endif @if(session('error')) onload='error()' @endif>
	<div class="wrapper">
		<header class="main-header">
				<nav class="navbar navbar-default navbar-static-top">
					<div class="container">
						<div class="navbar-header">
							<ul class="navbar-right nav navbar-nav" id="yw4">
								<li>
									<a href="#" class="navbar-brand">
										<img src="{{asset('images/lesstoranlogowhite.png')}}" width="130px" height="30px">
									</a>
								</li>
								<li>
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_collapse">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
									<a style="width:auto;margin-left: 0px;" class="navbar-brand" href="#"></a>
								</li>
							</ul>
						</div>
						@include('admin.layouts.navbar')
					</div>
				</nav>
		</header>
		<div class="content-wrapper">
			@yield('content')
		</div>
	</div>
	<script src="{{asset('jquery')}}/dist/jquery.min.js"></script>
	
	<script src="{{asset('bootstrap')}}/dist/js/bootstrap.min.js"></script>
	
	<div id="successModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal_title">Keterangan</h4>
					</div>
					<div class="modal-body alert alert-success fade-in">
						{!! session('success') !!}
					</div>
					<div class="modal-footer">
						@if (session('info'))
						{!! session('info') !!}
						@endif
						<button type="button" class="btn btn-default" data-dismiss="modal"> Tutup </button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="errorModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal_title">Keterangan</h4>
					</div>
					<div class="modal-body alert alert-danger fade-in">
						{!! session('error') !!}
					</div>
					<div class="modal-footer">
						<input type="hidden" name="id" id="hapus_id" value="" />
						<button type="button" class="btn btn-default" data-dismiss="modal"> Tutup </button>
					</div>
				</div>
			</div>
		</div>
	</div>

	@yield('scripts')
	<script type="text/javascript">
		function success(){
			$('#successModal').modal('show');
		}
		function error(){
			$('#errorModal').modal('show');
		}
	</script>
</body>
</html>
