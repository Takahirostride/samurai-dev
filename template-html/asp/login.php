<?php include ('./inc/header_nologin.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="" method="POST" role="form" class="authform">
                            <div class="form-group bgline">
                                <div class="w30">
                                    <label for="">メールアドレス</label>
                                </div>
                                <div class="w70">
                                    <input type="text" class="form-control" id="" placeholder="eg: jaison.justus">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group bgline">
                                <div class="w30">
                                    <label for="">パスワード</label>
                                </div>
                                <div class="w70">
                                    <input type="text" class="form-control" id="" placeholder="..........">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="switch pull-left">
                                  <input type="checkbox" name="save">
                                  <span class="slider"></span>
                                </label>
                                <lable class="pull-left checktext">次回から自動でログインする</lable>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group text-center">
                                <button type="button" onclick="window.location.href='index.php';" class="btn btn-authform btn-lg btn-login">ログイン</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <script src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
    </body>
</html>