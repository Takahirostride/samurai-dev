<tr>
    <td>{{ $client->company_name }}</td>
    <td>{{ $client->userLocation->provinceName() }}</td>
    <td>{{ $client->userLocation->cityName() }}</td>
    <td>{{ $client->phone_number }}</td>
    <td>{{ $client->loginInfo ? $client->loginInfo->login_day->format('Y/m/d'):'' }}</td>
    <td>{{ $client->created_at->format('Y/m/d') }}</td>
    <td>{{ $client->aspUserLog ? $client->aspUserLog->sended_at->format('Y/m/d') :'' }}</td>
    <td><a href="{{ route('asp_client_document',$client) }}" class="btn btn-default btn-linkmail">メールアドレスを追加する</a></td>
    <td><a href="{{ route('asp_status_client_subsidy',$client) }}"><span class="countsell">{{ $client->hire_count ?? 0 }}<span class="txt-lg">件</span></span></a></td>
    @php
        $p_apply = $client->aspUserLog ? $client->aspUserLog->policy_register : 0;
    @endphp
    <td><span class="countsell">{{ $p_apply }}<span class="txt-lg">件</span></span></td>
    <td>@include('Asp::layouts.partial_file.btn_favorite',['element'=>@$client])</td>
</tr> 