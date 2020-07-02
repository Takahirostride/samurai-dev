@php
    if(!isset($client)){ return false;}
    $rt_name = Route::currentRouteName();
@endphp
<div class="navbar" id="nav-status">
        <ul class="lst-inl">
            <li>
                <p class="mr0 small">個社情報</p>
                <a href="{{ route('asp_manage_clients_register_preview',$client) }}">{{ $client->userName() }}</a>
            </li>
            <li>
                <a href="{{ route('asp_status_client_recruitment',$client) }}">
                    <span class="{{ $rt_name == 'asp_status_client_recruitment' ? 'active':'' }}">ステータス</span>
                </a>
            </li>
            <li>
                <a href="{{ route('asp_status_client_document',$client) }}">
                    <span class="{{ $rt_name == 'asp_status_client_document' ? 'active':'' }}">申請可能な案件</span>
                </a>                
            </li>
        </ul>
</div>