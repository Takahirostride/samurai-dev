<ul class="nav navbar-nav navbar-right hovernone">
	<li><a href="{{ url()->previous() }}" class="btn btn-default btn-lg">PREVIOUS</a></li>
	@if(Auth::guard('asp_user')->check())
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user fa-1 mgr-10" aria-hidden="true"></i>{{ Auth::guard('asp_user')->user()->full_name }} <b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="{{ route('asp_profile') }}">Profile</a></li>
			<li><a href="{{ route('asp_logout') }}">ログアウト</a></li>
		</ul>
	</li>
	@endif
</ul>