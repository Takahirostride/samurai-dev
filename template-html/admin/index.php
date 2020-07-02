<?php include ('./inc/header.php'); ?>
<div class="site">
    <header ng-controller="HeaderCtrl">
        <!-- ngInclude: header_path -->
        <div ng-include="header_path" >
            <div class="header ng-scope">
                <div class="header-top">
                    <div class="pull-left">
                        <ul>
                            <li class="active"><a href="">ログイン</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="header-bottom">
                    <ul class="navbar" style="margin-bottom:0px;">
                        <li><a href="">助成金・補助金マッチングサイトへ</a>
                        </li>
                        <li><a href="">ver1.0 &nbsp; </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>


    <!-- ngView: -->
    <div ng-view="" >
        <div class="container ng-scope">
            <div class="row" style="margin-top:150px">
                <strong>管理者メニュー：ログイン</strong>
            </div>
            <div class="row" style="margin-top:50px">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <p style="margin-left:0px;">ＩＤ・パスワードを入力してください</p>
                    <form action="" class="form-horizontal" method="POST">
                        <div class="form-group" style="margin-top:30px;">
                            <p class="col-sm-2">ID</p>
                            <div class="col-sm-5">
                                <input class="form-control" type="text" placeholder="ID" name="adminid">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:30px;">
                            <p class="col-sm-2">パスワード</p>
                            <div class="col-sm-5">
                                <input class="form-control" type="password" placeholder="パスワード" name="adminpassword">
                            </div>
                        </div>
                        <div class="form-group" style="margin-top:30px;">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-5">
                                <input type="submit" name="submit" class="submit-blue-btn" value="ログイン">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include ('./inc/footer.php'); ?>
