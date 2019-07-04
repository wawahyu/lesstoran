<div class="collapse navbar-collapse" id="navbar_collapse">
	<ul class="navbar-right nav navbar-nav" id="yw4">
		<li>
			<a href="{{url('/transaction')}}"><i class="fa fa-money"></i> <span class="badge" id="notif"> {{Auth::user()->myTransactionCount()}} Pembayaran</span></a>
		</li>
		<li>
			<a href="{{url('/order/myorder')}}"><i class="fa fa-cart-plus"></i> <span class="badge" id="notif"> {{Auth::user()->myOrderCount()}} Pesanan</span></a>
		</li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">{{Auth::user()->name}} ( {{Auth::user()->myRoleName()}} )  <span class="caret"></span></a>
			<ul id="yw5" class="dropdown-menu">
				<li>
					<a tabindex="-1" href="{{url('/order')}}"><i class="fa fa-arrow-left"></i> Halaman Depan </a>
				</li>
				<li class="divider"></li>
				<li>
					<a tabindex="-1" href="{{url('customer/myaccount')}}"><i class="fa fa-user"></i> Akunku </a>
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