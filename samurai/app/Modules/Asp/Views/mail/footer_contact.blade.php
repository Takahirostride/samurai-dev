	@php
		$user = auth('asp_user')->user();
		$link = url('register_affiliate/'.$user->id.'/');
		$lk_inquiry = url('/inquiry');
	@endphp	
<p style="margin-top:50px">助成金補助金自動マッチングシステム　「SAMURAI」への登録は下記のURLから登録してください。</p>
<p><a href="{{ $link }}">{{ $link }}</a></p>

<p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>
<p>【SAMURAI運営事務局】</p>
<p>　〒150-0036</p>
<p>東京都渋谷区南平台町3-13　新堀ビル3F</p>

<p>【お問合せ先】</p>
<p><a href="{{ $lk_inquiry }}">{{ $lk_inquiry }}</a></p>:
<p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p>