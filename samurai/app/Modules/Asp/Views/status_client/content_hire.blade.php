@php
    if(!isset($hire)){return false;}
@endphp
<table class="table table-date-policy table-bordered">
    <tbody>
        <tr>
            <td class="left-padding-job">
                <div class="hire-ct">
                <span class="title-ft">予定納期</span> ： <span class="bigtext">{!! ol_get_date_html($hire->deli_date) !!}</span>                    
                </div>
            </td>

        </tr>
        <tr>
            <td class="left-padding-job">
                <div class="hire-ct">
                <span class="title-ft">着手金支払い金額</span> ： <span class="bigtext">{{$hire->deposit_money_receive()}}</span></span> 円+税                    
                </div>
            </td>
        </tr>
        <tr>
            <td class="left-padding-job">
                <div class="hire-ct">
                <span class="title-ft">後払い金額</span> ： <span class="bigtext">{{$hire->deposit_money_fee()}}</span> 円+税
                </div>
            </td>
        </tr>
        <tr>
            <td class="left-padding-job">
                <div class="hire-ct">
                <span class="title-ft">終了日</span> ： <span class="bigtext">{!! ol_get_date_html($hire->finish_date) !!}</span>
                </div>
            </td>
        </tr>
    </tbody>
</table>