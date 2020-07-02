@php
    if(!isset($element)||empty($element->user)){ return false;}
    $client = $element->user;
    $is_register = false;
    $is_add_mail = false;
    if($element->is_register==1){
        $is_register = true;
    }
    if($element->is_add_mail==1){
        $is_add_mail = true;
    }    
@endphp
<tr>
    <td><a href="{{ route('asp_status_client_document',$client) }}" class="link">{{ $client->company_name }}</a></td>
    <td>{{ $client->userLocation->provinceName() }}</td>
    <td>{{ $client->userLocation->cityName() }}</td>
    <td>{{ $client->phone_number }}</td>
    <td>{{ $client->loginInfo ? $client->loginInfo->login_day->format('Y/m/d'):'' }}</td>
    <td>{{ $client->created_at->format('Y/m/d') }}</td>
    <td>
        @if($is_register)
            {{ $element->sended_at->format('Y/m/d')}}
        @elseif($is_add_mail)
            <button type="button" class="btn btn-default btn-linkmail btn-send" data-id="{{ $client->id }}">招待メールを送る</button>
        @else
            <button type="button" class="btn btn-default btn-gray btn-popup" data-id="{{ $client->id }}">招待メールを送る</button>
        @endif        
    </td>
    <td>
        @if($is_add_mail)
            <span class="btn-email">{{ $client->e_mail }}</span>
        @else
            <a href="{{ route('asp_manage_clients_register',['client_id'=>$client->id]) }}" class="btn btn-default btn-linkmail btn-register">メールアドレスを追加する</a>
        @endif         
    </td>
    <td>
        @if($client->hire_count)
        <a href="{{ route('asp_status_client_document',$client) }}"><span class="countsell">{{ $client->hire_count}}<span class="txt-lg">件</span></span></a>
        @else
        <span class="countsell">0<span class="txt-lg">件</span></span>
        @endif
    </td>
    <td>
        @if($client->hire_doing)
        <a href="{{ route('asp_status_client_recruitment',$client) }}"><span class="countsell">{{ $client->hire_doing}}<span class="txt-lg">件</span></span></a>
        @else
        <span class="countsell">0<span class="txt-lg">件</span></span>
        @endif
    </td>    
    <td>@include('Asp::layouts.partial_file.btn_favorite',['element'=>@$client])</td>
</tr> 