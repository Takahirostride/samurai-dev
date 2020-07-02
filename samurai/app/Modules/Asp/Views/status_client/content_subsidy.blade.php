@php
    if(!isset($element)){ return false;}  
    $is_register = empty($element->user_id) ? false:true;
    $is_add_mail = empty($element->email) ? false : true;
@endphp
<tr class="row-link" data-link="{{ route('asp_status_client_document',['id'=>$element->id]) }}">
    <td>{{ $element->name }}</td>
    <td>{{ $element->province ? $element->province->province_name : $element->other_province }}</td>
    <td>{{ $element->getCityName() }}</td>
    <td>{{ $element->loginInfo ? $element->loginInfo->login_day->format('Y/m/d'):'' }}</td>
    <td>{{ $element->created_at->format('Y/m/d') }}</td>
    <td class="noLink">
        @if($is_register)
            {{ $element->sended_at ? $element->sended_at->format('Y/m/d'):''}}   
        @elseif($is_add_mail)
            <button type="button" class="btn btn-default btn-linkmail btn-send" data-id="{{ $element->id }}">招待メールを送る</button>
        @else
            <button type="button" class="btn btn-default btn-gray btn-popup">招待メールを送る</button>
        @endif       
    </td>
    <td class="noLink">
        @if($is_add_mail)
            <span class="btn-email">{{ $element->email }}</span>
        @else
            <a href="{{ route('asp_manage_clients_register_preview',['client_id'=>$element->id]) }}" class="btn btn-default btn-linkmail btn-register">メールアドレスを追加する</a>
        @endif               
    </td>
    <td class="noLink">
        @php
            $recom = $element->countRecommend();
        @endphp
        @if($recom)
        <a href="{{ route('asp_status_client_document',$element) }}"><span class="countsell">{{ $recom}}<span class="txt-lg">件</span></span></a>
        @else
            <span class="countsell">0<span class="txt-lg">件</span></span>
        @endif
    </td>
    <td class="noLink">
        @php
            $doing = $element->user && $element->user->clientStatistic ? $element->user->clientStatistic->getDoing() : 0;
        @endphp        
        @if($doing)
        <a href="{{ route('asp_status_client_recruitment',['id'=>$element->id]) }}"><span class="countsell">{{ $doing}}<span class="txt-lg">件</span></span></a>
        @else
        <span class="countsell">0<span class="txt-lg">件</span></span>
        @endif
    </td>
    <td class="td-fav noLink">@include('Asp::manage_user.partials.btn_favorite',['element'=>@$element])</td>
</tr> 