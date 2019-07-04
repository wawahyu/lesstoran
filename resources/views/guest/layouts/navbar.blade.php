<div class="collapse navbar-collapse" id="navbar_collapse">
	<ul class="navbar-right nav navbar-nav" id="yw4">
		<li>
			<a href="{{url('/transaction')}}"><i class="fa fa-money"></i> <span class="badge" id="notif">  Pembayaran</span></a>
		</li>
		<li>
			<a href="{{url('/order/myorder')}}"><i class="fa fa-cart-plus"></i> <span class="badge" id="notif"> {{$o}} Pesanan</span></a>
		</li>
		<li>
			<a href="{{url('home')}}">Login</a>
		</li>
		
	</ul>
</div>