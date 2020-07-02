<div class="header-bottom">
    <ul class="navbar" style="margin-bottom:0px;">
        <li @if(strpos('a'.\Request::route()->getName() , 'employee.top')) class="active" @endif ><a href="{{URL::to('/admin/employee')}}">TOP</a></li>
        <li @if(strpos(\Request::url() , '/employee/balance')) class="active" @endif ><a href="{{URL::to('/admin/employee/balance/sale')}}">収支管理</a></li>
        <li @if(strpos(\Request::url() , '/employee/system')) class="active" @endif ><a href="{{URL::to('/admin/employee/system/uservoice')}}">システム管理</a></li>
        <li @if(strpos(\Request::url() , '/employee/customerinfo')) class="active" @endif ><a href="{{URL::to('/admin/employee/customerinfo/agencylist')}}">顧客情報管理</a></li>
        {{-- <li @if(strpos(\Request::url() , '/employee/customersupport')) class="active" @endif ><a href="{{URL::to('/admin/employee/customersupport/contact')}}">顧客対応管理</a></li> --}}
        <li @if(strpos(\Request::url() , '/employee/data')) class="active" @endif ><a href="{{URL::to('/admin/employee/data/subsidylist')}}">施策データ管理</a></li>
        <li @if(strpos(\Request::url() , '/employee/other')) class="active" @endif ><a href="{{URL::to('/admin/employee/other/affiliate')}}">その他管理</a></li>
        {{-- <li><a href="">ver1.0 &nbsp; </a></li> --}}
    </ul>
</div>