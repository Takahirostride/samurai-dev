<tr class ="row-link" data-link="{{ route('asp_policy_clients',$val) }}">
    <td class="td-name">
        {{ str_limit($val->name,20) }}
    </td>
    <td>{{ $val->companyName() }}</td>
    <td>{{ $val->acquire_budget_display }}</td>
    <td class="th_header"> 
        <div class="tog-text">
        <p>{!! str_limit(strip_tags($val->support_content),50) !!}</p>
        <div class="tog-but row-act noLink" data-block="#show_{{ $val_index }}">
            <span class="ico"><i class="fas fa-chevron-down"></i></span>
        </div>             
        </div>              
    </td>
    <td  rowspan="2" class="td-fav noLink">
        @include('Asp::layouts.partial_file.btn_favorite_subsidy',['element'=>$val])
    </td>
</tr>
<tr>
    <td colspan="4" class="hide_item" id="show_{{ $val_index }}">
        <div class="create-link-box-x">
            @include('Asp::search.content_subsidy_detail',['policy'=>$val])
        </div>
    </td>
</tr>