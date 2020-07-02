@php
    $rt_name = Route::currentRouteName();
    $user = auth('asp_user')->user();
@endphp
<nav class="navbar navbar-default" role="navigation" id="nav-top">
    <div class="row">
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-top">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1 class="site-title">
                <a href="{{url('/asp')}}" class="navbar-brand">
                    <img src="{{ asset('assets/asp/images/logo-asp.png') }}" class="logo-img" alt="SAMURAI">
                </a>
            </h1>
        </div>        
    </div>
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
        <div class="collapse navbar-collapse navbar-ex1-collapse" id="menu-top">
            <ul class="lst-menu">
                <li class="nav-item">
                    <a class="{{ $rt_name=='asp_home_page'?'active':'' }}" href="{{ route('asp_home_page') }}">
                        顧客ステータス
                    </a>
                </li>                
                <li class="nav-item dropdown dropdown-hv">
                    <a class="nav-link dropdown-toggle {{ in_array($rt_name,['asp_search_subsidy','asp_status_client_index'])?'active':'' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        補助金／助成金検索
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="{{ $rt_name=='asp_search_subsidy'?'active':'' }}" href="{{route('asp_search_subsidy')}}">条件から絞り込んで探す</a></li>
                        <li><a class="{{ $rt_name=='asp_status_client_index'?'active':'' }}" href="{{ route('asp_status_client_index') }}">顧客から案件を探す</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-hv">
                    <a class="nav-link dropdown-toggle {{ preg_match('/^asp_manage/',$rt_name)?'active':'' }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        顧客管理
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('asp_manage_clients') }}" class="{{ $rt_name=='asp_manage_clients'?'active':'' }}">顧客一覧</a></li>
                        <li><a href="{{ route('asp_manage_clients_register_custom') }}" class="{{ $rt_name=='asp_manage_clients_register_custom'?'active':'' }}">顧客手動登録</a></li>
                        <li><a href="{{ route('asp_manage_clients_csv') }}" class="{{ $rt_name=='asp_manage_clients_csv'?'active':'' }}">顧客登録（CSV）</a></li>
                        <li><a href="{{ route('asp_manage_clients_favorite') }}" class="{{ $rt_name=='asp_manage_clients_favorite'?'active':'' }}">担当企業</a></li>
                        <li><a href="{{ route('asp_manage_clients_invation') }}" class="{{ $rt_name=='asp_manage_clients_invation'?'active':'' }}">招待管理</a></li>
                        @if($user->isMod())
                        <li><a href="{{ route('asp_manage_clients_invation_group') }}" class="{{ $rt_name=='asp_manage_clients_invation_group'?'active':'' }}">招待管理 group</a></li>
                        @endif
                        <li><a href="{{ route('asp_manage_clients_hire_history') }}" class="{{ $rt_name=='asp_manage_clients_hire_history'?'active':'' }}">出力履歴</a></li>
                    </ul>
                </li>
            </ul> <!-- end ul.nav -->
        </div>        
    </div>
    <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
        <div class="box-user dropdown dropdown-hv">
            @php
                $active = in_array($rt_name,['asp_profile','asp.users.index','asp_manager_account','asp_signature']) ? 'active' : '';
            @endphp
            <a class="nav-link dropdown-toggle {{ $active }}" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                アカウント管理
                <i class="fas fa-chevron-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li><a href="{{ route('asp_profile') }}" class="{{ $rt_name=='asp_profile'?'active':'' }}">マイアカウント</a></li>
                @if($user->isAdmin())
                <li>
                    <a href="{{ route('asp.users.index') }}" class="{{ $rt_name=='asp.users.index'?'active':'' }}">Asp Manager</a>
                </li>
                @elseif($user->isMod())
                    <li>
                        <a href="{{ route('asp_manager_account') }}" class="{{ $rt_name=='asp_manager_account'?'active':'' }}">アカウント管理</a>
                    </li>
                @endif  
                <li><a href="#">契約管理</a></li>                               
                <li><a href="{{ route('asp_signature') }}" class="{{ $rt_name=='asp_signature'?'active':'' }}">署名管理</a></li>                               
                <li><a href="{{ route('asp_logout') }}">ログアウト</a></li>
            </ul>            
        </div>
       
    </div>
    </div>
</nav>