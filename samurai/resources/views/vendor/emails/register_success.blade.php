<body>
	<p>{{$user->displayname}} 様<br>
	『助成金・補助金自動マッチングサイトSAMURAI』にご登録いただき誠にありがとうございます。<br>
<br>
下記のリンクをクリックすると会員登録の認証が完了します。<br>
ログイン後プロフィールを設定する事で今申請できる助成金・補助金の情報を確認いただけます。<br>
		
    </p>

    <a href="{{ url('/verify/'.$user->api_token) }}">{{ url('/verify/'.$user->api_token) }}</a>
    <br>
    <br> 
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
【SAMURAI運営事務局】<br>
　〒150-0036<br>
　東京都渋谷区南平台町3-13　新堀ビル3F
<br>
【お問合せ先】<br>
　https://samurai-match.jp/inquiry<br>

※原則として、3営業日以内に返信いたします。<br>
※土日祝日はお時間をいただく場合があります。<br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
　このメールの送信アドレスは送信専用です。<br>
　ご返信頂きましても内容にはお答えできませんのでご注意ください。<br>
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━<br>
</body>