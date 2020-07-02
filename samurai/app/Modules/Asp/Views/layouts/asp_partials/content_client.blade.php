<div class="p-item">
    <div class="col-xs-3">
        <div class="tb-contain">
            <div class="tb-cell tb-img">
                @php
                    $img_url = ($element->image)?asset($element->image) :asset('assets/common/images/client.png');
                @endphp
                <img src="{{ $img_url }}" alt="">
            </div>
            <div class="tb-cell">
                <p class="cli-meta">
                    @if(!$element->trade->isEmpty())
                    <span>{{ $element->trade->first()->trade }}|</span>
                    @endif
                    @if(!$element->cats->isEmpty())
                    <span>{{ $element->cats->first()->category_name }}|</span>
                    @endif
                </p>
                <p class="cli-name">{{ $element->company_name }}</p>
            </div>
        </div>
        <p class="cli-estable">
            <span>設立年月:</span>
            @if($element->data)
            {{$element->data->estable_date->format('Y年m月d日')}}
            @endif
        </p>    
    </div>
    <div class="col-xs-7">
        <div class="meta-top">
            <div class="item-half">住所 : {{ $element->addressName() }}</div>
            <div class="item-half">email: {{ $element->e_mail }}</div>
        </div>
        <p class="text-desc">{!! $element->self_intro !!}</p>
    </div> <!-- end .col-xs-8 -->
    <div class="col-xs-2 list-right-item">
        @include('Asp::layouts.asp_partials.btn_favorite')
        @php            
            $btn_cls = (!empty($element->aspUserLog) && $element->aspUserLog->is_register==1) ? 'bg-black':'';
        @endphp
        <a href="{{ route('asp_client_information',$element) }}" class="btn btn-primary {{ $btn_cls }}">詳細</a>
    </div>
    <div class="col-xs-12 pitem-meta-bottom">
        <a class="btn btn-default" href="{{ route('asp_client_information',$element) }}">基本情報</a>
        <a class="btn btn-default" href="{{ route('asp_client_subsidy',$element) }}">助成金・補助金情報</a>
        <a class="btn btn-default" href="{{ route('asp_client_using',$element) }}">samurai 登録</a>
        <a class="btn btn-default" href="{{ route('asp_client_document',$element) }}">資料</a>
    </div>
</div> <!-- end .p-item -->