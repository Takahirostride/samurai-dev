@php
	$avatar = ($user->avatar) ? asset($user->avatar) : asset('assets/common/images/fa-avatar.png');
    $role_group = ($user->pivot &&  $user->pivot->role == 1) ? 'Manager' : 'Member';
@endphp
<div class="displaytb">
    <div class="boxlinksmall text-center">
        <img class="smallimg" src="{{ $avatar }}" alt="">  
        <span class="infouser">
           {{ $user->fullname }}<br>{{ $role_group }}
        </span>
        <a href="{{ route('asp_manager_account_edit',$user) }}"></a>             
    </div>
</div>