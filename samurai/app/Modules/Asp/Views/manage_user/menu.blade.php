@php
	$rt_name = Route::currentRouteName();
@endphp
<div class="navbar" id="nav-manage">
		<ul class="nav navbar-nav">
			<li class="active">
				<a href="{{ route('asp_manage_clients') }}" class="{{ $rt_name=='asp_manage_clients'?'active':'' }}">顧客／担当一覧</a>
			</li>
			<li>
				<a href="{{ route('asp_manage_clients_csv') }}" class="{{ $rt_name=='asp_manage_clients_csv'?'active':'' }}">顧客／担当登録</a>
			</li>
			<li>
				<a href="{{ route('asp_manage_clients_favorite') }}" class="{{ $rt_name=='asp_manage_clients_favorite'?'active':'' }}">お気に入り</a>
			</li>
			
		</ul>
</div>