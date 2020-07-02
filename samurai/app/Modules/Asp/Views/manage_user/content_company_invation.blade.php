@php
    if(!isset($element)){ return false;}   
@endphp
<tr>
    <td>{{ $element->name }}</td>
    <td>{{ $element->province ? $element->province->province_name : $element->other_province }}</td>
    <td>{{ $element->getCityName() }}</td>
    <td class="td-mail">{{ $element->email }}</td>
    <td>
        @if($element->is_register==0 && !empty($element->email))
            <button type="button" class="btn btn-default btn-linkmail btn-send" data-id="{{ $element->id }}">招待メールを送る</button>
        @elseif($element->sended_at)
            {{ $element->sended_at->format('Y/m/d') }} 
        @endif      
    </td>        
    <td>
        {{ $element->created_at->format('Y/m/d') }}
    </td>
</tr> 