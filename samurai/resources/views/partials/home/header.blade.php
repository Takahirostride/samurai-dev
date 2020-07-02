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
                            <a href="{{URL::to('/')}}" class="navbar-brand">
                                {{HTML::image('assets/common/images/logo.png')}}
                            </a>
                        </h1>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{URL::to('/')}}">マイページ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{URL::to('/whatissamurai')}}">士(SAMURAI)とは</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{URL::to('/seminarinfo')}}">説明会</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{URL::to('/howtouse')}}">はじめての方</a>
                            </li>
                            
                        </ul>
                        <ul class="nav nav-pills float-right">
                            <li class="nav-item dropdown">
                                <a href="{{URL::to('/login')}}" class="btn btn-primary">ログイン</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="{{URL::to('/register')}}" class="btn btn-register">無料会員登録</a>
                            </li>
                        </ul> <!-- end ul.nav -->
                    </div><!-- /.navbar-collapse -->
                </div> <!-- end .container-fluid -->
            </nav>
        </div> <!-- end .col-sm-12 -->
    </div> <!-- end .row --> 
</div> <!-- end .header -->