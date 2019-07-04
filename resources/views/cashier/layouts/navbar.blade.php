<div class="collapse navbar-collapse" id="navbar_collapse">
	<ul class="navbar-right nav navbar-nav" id="yw4">
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Pengguna <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="{{url('cashier/user/filter/pelanggan')}}"><i class="fa fa-user"></i> Pelanggan </a></li>
				<li class="divider"></li>
				<li><a href="{{url('cashier/user/filter/pegawai')}}"><i class="fa fa-black-tie"></i> Pegawai </a></li>
			</ul>
		</li>
		<li>
			<a href="{{url('cashier/transaction/list')}}"><i class="fa fa-file-text-o"></i> Pembayaran <span class="badge" id="notif"> {{Auth::user()->cashierOrderCount()}}</span></a>
		</li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tasks"></i> Laporan <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li>
					<a href="{{url('cashier/laporan/filter/masakan')}}"><i class="fa fa-coffee"></i> Masakan <span class="badge"></span></a>
				</li>
				<li>
					<a href="{{url('cashier/laporan/filter/pelanggan')}}"><i class="fa fa-user"></i> Pelanggan </a>
				</li>
				<li>
					<a href="{{url('cashier/laporan/filter/pesanan')}}"><i class="fa fa-clipboard"></i> Pesanan </a>
				</li>
				<li>
					<a href="{{url('cashier/laporan/filter/transaksi')}}"><i class="fa fa-money"></i> Transaksi </a>
				</li>
			</ul>
		</li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">{{Auth::user()->name}} ( {{Auth::user()->myRoleName()}} )  <span class="caret"></span></a>
			<ul id="yw5" class="dropdown-menu">
				<li>
					<a tabindex="-1" href="{{url('cashier/order')}}"><i class="fa fa-arrow-left"></i> Halaman Depan </a>
				</li>
				<li class="divider"></li>
				<li>
					<a tabindex="-1" href="{{url('cashier/myaccount')}}"><i class="fa fa-user"></i> Akunku </a>
				</li>
				<li class="divider"></li>
				<li>
					<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
				</li>
			</ul>
		</li>
	</ul>
</div>