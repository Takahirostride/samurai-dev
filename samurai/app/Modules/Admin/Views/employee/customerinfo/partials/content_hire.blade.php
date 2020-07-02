@php
    if(!isset($value)){ return false;}
@endphp
<tr>
    <td>{{ ol_get_date_string_time($value->created_at) }}</td>
    <td>{{ ol_get_date_string($value->deli_date) }}</td>
    <td>{{ ol_get_date_string($value->finish_date) }}</td>
    <td>
        <a href="{{ route('admin.employee.data.subsidy_edit',['id'=>$value->policy->id]) }}">{{ $value->policy->name }}</a>
    </td>
    <td>
        @php
            $client = $value->getClient();
        @endphp
        @if($client)
        {{ $client->displayname ? $client->displayname : $client->username }}
        @endif
    </td>
    <td>
        @php
            $agency = $value->getAgency();
        @endphp
        @if($agency)
        {{ $agency->displayname ? $agency->displayname : $agency->username }}
        @endif
    </td>
    <td>{{ $value->deposit_money_receive() }}</td>
    <td>
        {{ $value->deposit_money_fee($fee) }}
    </td>
</tr>