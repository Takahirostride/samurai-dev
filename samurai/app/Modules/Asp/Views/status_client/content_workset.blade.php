@php
    if(!isset($element)){ return false;}
@endphp
    <div class="avatar workset">
        <span class="image">
            <img src="{{ $element->imageUrl() }}" alt="">
        </span>
    </div>
    <p class="name">{{ $element->user ? $element->user->userName() : '' }}</p>
    <p class="title">{{WorkSetString($element->work_content, $element->work_content_other_value, $element->work_content_other)}}</p>
    <p class="date">{{ $element->schedule }}</p>