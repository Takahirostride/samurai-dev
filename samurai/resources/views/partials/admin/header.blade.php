<div class="header-top">
    <div class="pull-left">
        <ul>
            <li @if(strpos(\Request::url() , '/admin/master')) class="active" @endif ><a href="{{URL::to('/admin/master')}}">マスター管理</a></li>
            <li @if(strpos(\Request::url(), '/admin/employee')) class="active" @endif ><a href="{{URL::to('/admin/employee')}}">施策データ管理</a></li>
        </ul>
        </div>
        <div class="pull-right">
            <ul>
                <li><a href="" class="ng-binding">ログイン者名 &nbsp; &nbsp; {{session('admin_name')}}</a></li>
                <li><a href="{{URL::to('/admin/logout')}}">ログアウト</a></li>
            </ul>
        </div>
</div>
