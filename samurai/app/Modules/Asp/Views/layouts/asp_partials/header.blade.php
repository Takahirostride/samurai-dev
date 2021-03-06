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
                        <ul class="nav nav-pills float-left">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" class="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    補助金／助成金検索
                                    <span class="caret-asp">＞</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">条件から絞り込んで探す</a></li>
                                    <li><a href="#">顧客から案件を探す</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#">
                                    顧客ステータス
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" class="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    顧客管理
                                    <span class="caret-asp">＞</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">顧客一覧</a></li>
                                    <li><a href="#">顧客登録（CSV）</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav nav-pills float-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" class="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                   アカウント管理
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">アカウント登録</a></li>
                                    <li><a href="#">契約管理</a></li>
                                </ul>
                            </li>
                        </ul> <!-- end ul.nav -->
                    </div><!-- /.navbar-collapse -->
                </div> <!-- end .container-fluid -->
            </nav>
        </div> <!-- end .col-sm-12 -->
    </div> <!-- end .row --> 
</div> <!-- end .header -->