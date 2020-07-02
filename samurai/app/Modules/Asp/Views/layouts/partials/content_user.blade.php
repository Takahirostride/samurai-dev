@php
	$avatar = ($user->avatar) ? asset($user->avatar) : asset('assets/common/images/fa-avatar.png');
    $role_group = isset($role_group) ? $role_group : 'Member';
@endphp
<div class="displaytb">
    <div class="boxlinksmall text-center">
        <img class="smallimg" src="{{ $avatar }}" alt="">  
        <span class="infouser">
           {{ $user->fullname }}<br>{{ $role_group }}
        </span>
        <a href="{{ route('asp.users.edit',$user) }}"></a>
        @if(isset($delete))
        <a href="{{ route('asp.users.destroy',$user) }}" class="btn-del olBtnDel" data-refesh="{{ request()->fullUrl() }}"><span class="fas fa-times-circle"></span></a>
        @endif              
    </div>
</div>