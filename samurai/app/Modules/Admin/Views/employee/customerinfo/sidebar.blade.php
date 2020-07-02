@php
    $rt_name = Route::currentRouteName();
@endphp
<div class="sidebar-left">
    <ul>
        <ul>
            <li class="{{ preg_match('/getNewUser$/',$rt_name) ? 'active':'' }}"><a href="{{ route('admin.StaffPolicyController.getNewUser') }}">新規登録者一覧</a></li>
            <li class="{{ preg_match('/getAgencylist$/',$rt_name) ? 'active':'' }}"><a href="{{ route('admin.StaffPolicyController.getAgencylist') }}">士業情報一覧</a></li>
            <li class="{{ preg_match('/getClientlist$/',$rt_name) ? 'active':'' }}"><a href="{{route('admin.StaffPolicyController.getClientlist')}}">企業情報一覧</a></li>
            <li class="{{ preg_match('/getViolateUser$/',$rt_name) ? 'active':'' }}""><a href="{{route('admin.StaffPolicyController.getViolateUser')}}">違反者一覧</a></li>
            <li class="{{ preg_match('/getMatchinglist$/',$rt_name) ? 'active':'' }}""><a href="{{route('admin.StaffPolicyController.getMatchinglist')}}">マッチング管理</a></li>
        </ul>
    </ul>
</div>