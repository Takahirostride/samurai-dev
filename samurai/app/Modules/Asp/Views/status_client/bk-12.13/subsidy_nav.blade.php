@php
    if(!isset($client)){ return false;}
    $rt_name = Route::currentRouteName();
@endphp
<div class="navbar" id="nav-status">
        <ul class="lst-inl">
            <li>
                <a href="{{ route('asp_manage_clients_preview',$client) }}">{{ $client->userName() }}</a>
            </li>
            <li>
                <a href="{{ route('asp_status_client_recruitment',$client) }}">
                    <span class="{{ $rt_name == 'asp_status_client_recruitment' ? 'active':'' }}">ステータス</span>
                </a>
            </li>
            <li>
                <a href="{{ route('asp_status_client_document',$client) }}">
                    <span class="{{ $rt_name == 'asp_status_client_document' ? 'active':'' }}">資料作成・送付</span>
                </a>                
            </li>
        </ul>
</div>