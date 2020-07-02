@php
    if(!isset($policy_log) || !$policy_log->policy){return false;}
    $policy = $policy_log->policy;
@endphp
<div class="p-item">
    <div class="col-xs-2">
        @if($policy->image_id)
        <img src="{{ asset($policy->image_id) }}" alt="">
        @endif
    </div>
    <div class="col-xs-8 policy-link" onclick="window.location.href='{{ route('asp_policy_show',$policy) }}';">
        <p class="pitem-title">{{ $policy->name }}</p>
        <div class="pmeta-tags">
            @foreach ($policy->cat as $cat)
                <a href="#">{{ $cat->category_name }}</a>
            @endforeach
        </div>
        <p class="pmeta-region">登録期関:{{ $policy->companyName() }} / 募集時期:{{ $policy->update_date }}~{{ ol_get_date_string($policy->subscript_duration_detail) }}</p>
        <p class="text-desc">{!! nl2br($policy->target) !!}</p>
        <p class="ptext-price">融資視線：{{ $policy->acquireBudgetName() }}</p>
    </div> <!-- end .col-xs-8 -->
    <div class="col-xs-2 list-right-item">
        @php
            $fav_status = 1;
            $fav_cls = 'favor';
            if($policy_log->favorite==1){
                $fav_status =0;
                $fav_cls = 'dis-favor';
            }
        @endphp        
        <button type="button" class="btn btn-warning {{ $fav_cls }} olPolicyFavorite" data-id="{{ $policy->id }}" data-status="{{ $fav_status }}">お気に入り</button>
        <a href="{{ route('asp_policy_show',$policy) }}" class="btn btn-primary">印刷する</a>
    </div>
</div><!-- end .p-item -->