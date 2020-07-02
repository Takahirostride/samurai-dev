<div class="row header">
    <div class="col-sm-12">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <h1 class="site-title">
                            <a href="{{URL::to('/agency/home')}}" class="navbar-brand">
                                {{HTML::image('assets/common/images/logo.png')}}
                            </a>
                        </h1>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item @if(Route::currentRouteName()=='agency.index') active @endif">
                                <a class="nav-link" href="{{URL::to('/agency/home')}}">HOME</a>
                            </li>
                            <li class="nav-item @if(request()->segment(2) == 'mypage') active @endif">
                                <a class="nav-link" href="{{URL::to('/agency/mypage/home')}}">マイページ</a>
                            </li>
                            <li class="nav-item @if(request()->segment(3) == 'recruitment') active @endif">
                                <a class="nav-link" href="{{URL::route('agency.recruitment')}}">仕事管理</a>
                            </li>
                            <li class="nav-item @if(request()->segment(3) == 'check-list') active @endif">
                                <a class="nav-link" href="{{URL::route('agency.checklist')}}">お気に入りリスト</a>
                            </li>
                            
                        </ul>
                        <ul class="nav nav-pills float-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{URL::route('agency.home')}}">マイページTOP</a></li>
                                    <li><a href="{{URL::route('agency.recruitment')}}">仕事管理</a></li>
                                    <li><a href="{{URL::route('agency.checklist')}}">お気に入りリスト</a></li>
                                    <li><a href="{{URL::route('agency.profile')}}">プロフィール管理</a></li>
                                    <li><a href="{{URL::to('/logout')}}">ログアウト</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor:pointer;">
                                    <i class="fa fa-bell" aria-hidden="true" style="color:#4b8dcd; font-size: 28px;"></i>
                                    <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu notify" aria-labelledby="dropdownMenu3">
                                    <li style="border-bottom: 1px solid gainsboro;">
                                        <a style="cursor:pointer;"><b>お知らせ</b></a>
                                    </li>
                                    
                                    <li style="background-color:#f5f5f5;text-align:center;" ng-click="directtoviewallnoti()" role="button" tabindex="0"><a style="cursor:pointer;color:rgb(173, 4, 151);"><b>すべて見る</b></a></li>
                                  </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor:pointer;">
                                    <i class="fa fa-question-circle" aria-hidden="true" style="color:#4b8dcd; font-size: 28px;"></i>
                                    <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a href="{{URL::to('/inquiry')}}">お問い合わせ</a></li>
                                    <li><a href="{{URL::to('/termservice')}}">利用規約</a></li>
                                </ul>
                            </li>
                        </ul> <!-- end ul.nav -->
                    </div><!-- /.navbar-collapse -->
                </div> <!-- end .container-fluid -->
            </nav>
        </div> <!-- end .col-sm-12 -->
    </div> <!-- end .row --> 
</div> <!-- end .header -->