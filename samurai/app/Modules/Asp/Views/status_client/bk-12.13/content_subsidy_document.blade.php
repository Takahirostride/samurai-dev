@php
    $policy = $hire->policy;
@endphp
<tr>
    <td rowspan="2" class="td-sl">
        <input type="checkbox" name="hire_id[]" value="{{ $hire->id }}" class="cb-cir">
    </td>
    <td><a href="{{ route('asp_client_recruitment',$hire) }}">{{ str_limit($policy->name,20) }}</a></td>
    <td>{{ $policy->companyName() }}</td>
    <td>{{ $policy->acquire_budget_display }}</td>
    <td class="th_header">  
        <div class="tog-but tog-text" data-block="#show_{{ $policy_index }}">
            <p>{!! str_limit(strip_tags($policy->support_content),50) !!}</p>
            <span class="ico"><i class="fas fa-chevron-down"></i></span>
        </div>              
    </td>
    <td  rowspan="2" class="td-fav">
        @include('Asp::status_client.buttons.btn_favorite_hire',['element'=>$hire])
    </td>
</tr>
<tr>
    <td colspan="4" class="hide_item" id="show_{{ $policy_index }}">
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
                            <p><a href="{{ route('asp_client_recruitment',$hire) }}"><span class="sidy-tbig">{{ $policy->name }}</span></a></p>
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
                    <tr>
                        <td style="border-right: none"></td>
                        <td style="border-left: none">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="dpleft-bottom">
                                        <div class="dp-sp-scale">
                                            <span class="rounder-sp"><span></span>支援規模</span>
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
                                <div class="col-sm-4">
                                    @include('Asp::client.btn_mail_subsidy') 
                                    @include('Asp::layouts.partial_file.btn_favorite_subsidy_text',['element'=>$policy])
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </td>
</tr>