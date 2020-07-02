@php
    if(!isset($element)){ return false;}
    $is_register = false;
    if($element->is_register==1){
        $is_register = true;
    }   
@endphp
<tr>
    <td><a href="{{ route('asp_status_client_document',$element->user_id) }}" class="link">{{ $element->name }}</a></td>
    <td>{{ $element->province ? $element->province->province_name : $element->other_province }}</td>
    <td>{{ $element->getCityName() }}</td>
    <td>{{ $element->loginInfo ? $element->loginInfo->login_day->format('Y/m/d'):'' }}</td>
    <td>{{ $element->created_at->format('Y/m/d') }}</td>
    <td>
        @if($is_register)
            {{ $element->sended_at->format('Y/m/d')}}
        @elseif(!empty($element->email))
            <button type="button" class="btn btn-default btn-linkmail btn-send" data-id="{{ $element->id }}">招待メールを送る</button>   
        @endif        
    </td>
    <td class="td-mail">{{ $element->email }}</td>
    <td>
        @php
            $recom = $element->user ? $element->user->countRecommend() : 0;
        @endphp        
        @if($recom)
        <a href="{{ route('asp_status_client_document',['id'=>$element->user_id]) }}"><span class="countsell">{{ $recom}}<span class="txt-lg">件</span></span></a>
        @else
        <span class="countsell">0<span class="txt-lg">件</span></span>
        @endif
    </td>
    <td>
        @php
            $doing = $element->user && $element->user->clientStatistic ? $element->user->clientStatistic->getDoing() : 0;
        @endphp        
        @if($doing)
        <a href="{{ route('asp_status_client_recruitment',['id'=>$element->user_id]) }}"><span class="countsell">{{ $doing}}<span class="txt-lg">件</span></span></a>
        @else
        <span class="countsell">0<span class="txt-lg">件</span></span>
        @endif
    </td>    
    <td class="td-fav">@include('Asp::manage_user.partials.btn_favorite',['element'=>@$element])</td>
    <td>
        <a href="{{ route('asp_manage_clients_register_preview',['id'=>$element->id]) }}" class="btn btn-primary">顧客情報</a>
    </td>
    <td>
        <a href="{{ route('asp_manage_clients_register_destroy',['id'=>$element->id]) }}" class="btn btn-danger destroy-company">顧客削除</a>
    </td>
</tr> 