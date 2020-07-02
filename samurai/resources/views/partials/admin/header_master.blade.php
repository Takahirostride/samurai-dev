<div class="header-bottom">
    <ul class="navbar" style="margin-bottom:0px;">
        <li @if(strpos('a'.\Request::route()->getName() , 'master.top')) class="active" @endif ><a href="{{URL::to('/admin/master')}}">TOP</a></li>
        <li  @if(strpos('a'.\Request::route()->getName() , 'master.balance')) class="active" @endif ><a href="{{URL::to('/admin/master/balancedepwith')}}">収支管理</a></li>
        <li @if(strpos('a'.\Request::route()->getName() , 'master.profile')) class="active" @endif ><a href="{{URL::to('/admin/master/profile')}}">システム管理</a></li>
        {{-- <li><a href="">ver1.0 &nbsp; </a></li> --}}
    </ul>
</div>