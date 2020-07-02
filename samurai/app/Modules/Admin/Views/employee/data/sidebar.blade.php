@php
    $rt_name = request()->url();
    $rt_name = preg_replace('/\/$/','',$rt_name);
@endphp
<div class="sidebar-left">
    <ul>
        <ul>
            <li class="{{ preg_match('/subsidylist$/',$rt_name) ? 'active':'' }}"><a href="{{ route('admin.employee.data.subsidylist') }}">助成金データ一覧</a></li>
            <li class="{{ preg_match('/subsidyadd$/',$rt_name) ? 'active':'' }}""><a href="{{route('admin.employee.data.subsidyadd')}}">助成金データ新規登録</a></li>
            <li class="{{ preg_match('/document$/',$rt_name) ? 'active':'' }}""><a href="{{route('admin.employee.data.document')}}">書類管理</a></li>
            <li class="{{ preg_match('/registration$/',$rt_name) ? 'active':'' }}""><a href="{{route('admin.employee.data.registration')}}">登録募集施策</a></li>
        </ul>
    </ul>
</div>