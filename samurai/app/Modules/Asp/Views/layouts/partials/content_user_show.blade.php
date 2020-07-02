@php
	$avatar = ($user->avatar) ? asset($user->avatar) : asset('assets/common/images/fa-avatar.png');
@endphp
<div class="displaytb">
    <div class="boxlinksmall text-center">
        <img class="smallimg" src="{{ $avatar }}" alt="">  
        <span class="infouser">
           {{ $user->fullname }}<br>{{ $user->roleName() }}
        </span>
    </div>
</div>