@php
    if(!isset($client)){ return false;}  
    $is_register = empty($client->is_register) ? false:true;
    $is_add_mail = empty($client->email) ? false : true;

@endphp
<tr class="row-link" data-link="{{ route('asp_status_client_document',$client) }}">
    <td class="td-name">{{ $client->name }}</td>
    <td>{{ $client->province ? $client->province->province_name : $client->other_province }}</td>
    <td>{{ $client->getCityName() }}</td>
    <td>{{ $client->loginInfo ? $client->loginInfo->login_day->format('Y/m/d'):'' }}</td>
    <td>{{ $client->created_at->format('Y/m/d') }}</td>
    <td class="noLink">
        @if($is_register)
            {{ $client->sended_at ? $client->sended_at->format('Y/m/d'):''}}   
        @elseif($is_add_mail)
            <button type="button" class="btn btn-default btn-linkmail btn-send" data-id="{{ $client->id }}">招待メールを送る</button>
        @else
            <button type="button" class="btn btn-default btn-gray btn-popup">招待メールを送る</button>
        @endif       
    </td>
    <td class="noLink">
        @if($is_add_mail)
            <span class="btn-email">{{ $client->email }}</span>
        @else
            <a href="{{ route('asp_manage_clients_register_preview',['client_id'=>$client->id]) }}" class="btn btn-default btn-linkmail btn-register">メールアドレスを追加する</a>
        @endif               
    </td>
    <td class="noLink">
        @php
            $recom = $client->countRecommend();
        @endphp
        @if($recom)
        <a href="{{ route('asp_status_client_document',$client) }}"><span class="countsell">{{ $recom}}<span class="txt-lg">件</span></span></a>
        @else
            <span class="countsell">0<span class="txt-lg">件</span></span>
        @endif
    </td>
    <td class="noLink">
        @php
            $doing = $client->user && $client->user->clientStatistic ? $client->user->clientStatistic->getDoing() : 0;
        @endphp        
        @if($doing)
        <a href="{{ route('asp_status_client_recruitment',['id'=>$client->id]) }}"><span class="countsell">{{ $doing}}<span class="txt-lg">件</span></span></a>
        @else
        <span class="countsell">0<span class="txt-lg">件</span></span>
        @endif
    </td>
    <td class="td-fav noLink">@include('Asp::manage_user.partials.btn_favorite',['element'=>$client])</td>
</tr> 