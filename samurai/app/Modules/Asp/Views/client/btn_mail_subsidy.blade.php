@php
	if(empty($client->email)){ return false;}
@endphp
<button type="button" class="btn btn-primary btn-sendmail_policy" data-policy="{{ $policy->id }}" data-client="{{ $client->id }}">メール送信</button>