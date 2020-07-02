<!DOCTYPE html>
<html>
<head>
	<title>Samurai-match</title>
</head>
<body>
	<p>SAMURAIアカウント登録・編集</p>
	<p>アカウント名 : {{$user->fullname}}</p>
	@php
		$group_name = '';
		$user->load(['group']);
		if(!$user->group->isEmpty()){
			$group_name = $user->group->get(0)->title;
		}
	@endphp
	<p>グループ登録・編集 : {{$group_name}}</p>
	<p>権限:{{ $user->roleName() }}</p>
	<p>ログインID:{{ $user->account }}</p>
	<p>ログインパスワード:{{ request()->password }}</p>
	@php
		$url = route('asp_login');
	@endphp
	<p>Link login : <a href="{{ $url }}">{{ $url }}</a></p>
</body>
</html>