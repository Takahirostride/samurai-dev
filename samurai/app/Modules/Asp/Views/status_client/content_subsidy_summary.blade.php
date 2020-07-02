@php
    if(!isset($policy)){ return false;}
@endphp
<div class="create-link-box-x">
    <table class="table table-bordered subsidylist subsidylist-2">
        <tbody>
            <tr>
                <td rowspan="2">
                    @if($policy->image_id)
                    <img src="{{ asset($policy->image_id) }}">
                    @endif  
                        
                </td>
                <td>
                    <p><a href="{{ route('asp_policy_show',$policy) }}"><span class="sidy-tbig link">{{ $policy->name }}</span></span></p>
                    <p class="size1_3 text-primary">{{ $policy->name_serve }}</p>
                    <p class="text-right text-primary">
                        <strong>発行機関:</strong><span>{{ $policy->companyName() }}</span>/
                        <strong>対象地域:</strong>
                        @if($policy->policy_region && $policy->policy_region->province)
                        <span>{{$policy->policy_region->province->province_name}}</span>
                        @endif                                
                        <strong>募集時期:</strong><span>{{str_limit($policy->subscript_duration , 124)}}</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <ul class="tag-list">
                        @foreach($policy->tags as $tag)
                        <li><span>{{str_limit($tag->tag,10)}}</span></li>
                        @endforeach          
                    </ul>
                </td>
            </tr>
            <tr class="bl-collap">
                <td style="border-right: none"></td>
                <td style="border-left: none">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="dpleft-bottom">
                                <div class="dp-sp-scale">
                                    <span class="rounder-sp"><span></span>支援内容</span>
                                    {!! nl2br($policy->support_content) !!}
                                </div>
                                <div class="dp-sp-scale">
                                    <span class="rounder-sp"><span></span>支援規模</span>
                                    {!! nl2br($policy->support_scale) !!}
                                </div>
                                <div class="dp-sp-scale">
                                    <span class="rounder-sp"><span></span>施策種別</span>
                                    <p class="dsp-price">{{ empty($policy->acquire_budget_first) ? ' ': $policy->acquire_budget_first.':' }}
                {{ $policy->acquire_budget_display  }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>