@php
    if(!isset($value)){ return false;}
@endphp
<tr>
    <td colspan="8" class="td-pd0">
        <div class="box_work">
                <h3 class="hd-yellow">
                    <span>タスク進歩状況</span>
                    <span><span class="btn btn-acc olTogButton" data-block="#tall-list-{{ $loop->index }}"></span></span>
                </h3>
                @php
                    $work_sets = $value->workSet;
                @endphp
                @if($work_sets)
                <ul class="tallList bl-collap" id="tall-list-{{ $loop->index }}">
                    <li>
                        <div class="avatar">書類</div>
                        <p class="name">担当</p>
                        <p class="title">作業内容</p>
                        <p class="date">日付</p>
                    </li>
                    @foreach ($work_sets as $element)

                    <li>
                        <div class="avatar ite_file">
                            @include('Admin::employee.customerinfo.partials.content_file',['element'=>$element])
                        </div>
                        <p class="name">{{ $element->user ? $element->user->userName() : '' }}</p>
                        <p class="title">{{WorkSetString($element->work_content, $element->work_content_other_value, $element->work_content_other)}}</p>
                        <p class="date">{{ $element->schedule }}</p>
                    </li>
                    @endforeach
                </ul>
                @endif                                
        </div>        
    </td>
</tr>
