<!DOCTYPE html>
<html>
<head>
	<title>Samurai-match</title>
</head>
<body>
<p>samuraiのアカウントパスワードをリセットしました。</p> 
@php
	$link = route('asp_password_reset',['token'=>$token]);
@endphp
<p><a href="{{ $link }}">{{ $link }}</a></p>
<p>
です。<br/>新しいパスワードでsamuraiにログインし、パスワードを再登録してください。	
</p>

</body>
</html>