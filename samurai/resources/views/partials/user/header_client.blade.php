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
                            <a href="{{URL::to('/client/F0')}}" class="navbar-brand">
                                {{HTML::image('assets/common/images/logo.png')}}
                            </a>
                        </h1>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item @if(Route::currentRouteName()=='client.index') active @endif">
                                <a class="nav-link" href="{{URL::to('/client/F0')}}">HOME</a>
                            </li>
                            <li class="nav-item @if(request()->segment(2) == 'mypage') active @endif">
                                <a class="nav-link" href="{{URL::to('/client/mypage/home')}}">マイページ</a>
                            </li>
                            <li class="nav-item @if(request()->segment(3) == 'recruitment') active @endif">
                                <a class="nav-link" href="{{URL::route('client.recruitment')}}">仕事管理</a>
                            </li>
                            <li class="nav-item @if(request()->segment(3) == 'check-list') active @endif">
                                <a class="nav-link" href="{{URL::route('client.checklist')}}">お気に入りリスト</a>
                            </li>
                            
                        </ul>
                        <ul class="nav nav-pills float-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{URL::route('client.home')}}">マイページTOP</a></li>
                                    <li><a href="{{URL::route('client.recruitment')}}">仕事管理</a></li>
                                    <li><a href="{{URL::route('client.checklist')}}">お気に入りリスト</a></li>
                                    <li><a href="{{URL::route('client.profile')}}">プロフィール管理</a></li>
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
                                    
                                    <li style="background-color:#f5f5f5;text-align:center;" role="button" tabindex="0"><a style="cursor:pointer;color:rgb(173, 4, 151);"><b>すべて見る</b></a></li>
                                  </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="cursor:pointer;">
                                    <i class="fa fa-question-circle" aria-hidden="true" style="color:#4b8dcd; font-size: 28px;"></i>
                                    <span class="caret"></span>
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a href="{{URL::to('/inquiry')}}">お問い合わせ</a></li>
                                    <li><a href="{{URL::to('/howtouse')}}">初めての方</a></li>
                                </ul>
                            </li>
                        </ul> <!-- end ul.nav -->
                    </div><!-- /.navbar-collapse -->
                </div> <!-- end .container-fluid -->
            </nav>
        </div> <!-- end .col-sm-12 -->
    </div> <!-- end .row --> 
</div> <!-- end .header -->
