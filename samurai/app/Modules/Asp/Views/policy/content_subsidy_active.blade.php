<tr>
    <td><a href="{{ route('asp_policy_show',$val) }}" class="link">{{ str_limit($val->name,20) }}</a></td>
    <td>{{ $val->companyName() }}</td>
    <td>{{ str_limit($val->acquire_budget_display,30) }}</td>
    <td class="th_header">
        <div class="tog-but active tog-text" data-block="#show_{{ $val_index }}">
            <p>{!! str_limit(strip_tags($val->support_content),50) !!}</p>
            <span class="ico"><i class="fas fa-chevron-down"></i></span>
        </div>         
    </td>
</tr>
<tr>
    <td colspan="4" id="show_{{ $val_index }}" class='active'>
        <div class="create-link-box-x">
            <table class="table table-bordered subsidylist subsidylist-2">
                <tbody>
                    <tr>
                        <td rowspan="2">
                            @if($val->image_id)
                            <img src="{{ asset($val->image_id) }}">
                            @endif  
                                
                        </td>
                        <td>
                            <p><a href="{{ route('asp_policy_show',$val) }}"><span class="sidy-tbig link">{{ $val->name }}</span></a></p>
                            <p class="size1_3 text-primary">{{ $val->name_serve }}</p>
                            <p class="text-right text-primary">
                                <strong>発行機関:</strong><span>{{ $val->companyName() }}</span>/
                                <strong>対象地域:</strong>
                                @if($val->policy_region && $val->policy_region->province)
                                <span>{{$val->policy_region->province->province_name}}</span>
                                @endif                                
                                <strong>募集時期:</strong><span>{{str_limit($val->subscript_duration , 124)}}</span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <ul class="tag-list">
                                @foreach($val->tags as $tag)
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
                                            <span class="rounder-sp"><span></span>支援内容</span>
                                            {!! nl2br($val->support_content)!!}
                                        </div>
                                        <div class="dp-sp-scale">
                                            <span class="rounder-sp"><span></span>支援規模</span>
                                            {!! nl2br($val->support_scale) !!}
                                        </div>
                                        <div class="dp-sp-scale">
                                            <span class="rounder-sp"><span></span>施策種別</span>
                                            <p class="dsp-price">{{ empty($val->acquire_budget_first) ? ' ': $val->acquire_budget_first.':' }}
                        {{ $val->acquire_budget_display  }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                     @include('Asp::layouts.partial_file.btn_favorite_subsidy_text',['element'=>$val])
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr></tr>
                </tbody>
            </table>
        </div>
    </td>
</tr>