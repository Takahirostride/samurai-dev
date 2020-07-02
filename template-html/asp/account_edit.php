<?php include ('./inc/header.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="bg-danger heading-text">アカウント</p>
                    </div>
                    <!-- end .col-sm-12 -->
                </div>
                <!-- end .row -->
                <form action=""  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-7">
                            <legend>SAMURAIアカウント登録・編集</legend>
                            <table class="table form-bor middle">
                                <tbody>
                                    <tr class="form-group">
                                        <td><label for="">アカウント名</label><span class="required">必須</span></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" placeholder="名">
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" placeholder="名">
                                                </div>
                                            </div>
                                            
                                        </td>
                                    </tr>
                                    <tr class="form-group">
                                        <td><label for="">グループ登録・編集</label><span class="required">必須</span></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select name="" class="form-control" required="required">
                                                        <option value=""></option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-group">
                                        <td><label for="">権限</label><span class="required">必須</span></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <select name="" class="form-control" required="required">
                                                        <option value=""></option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="form-group">
                                        <td><label for="">通知用メールアドレス</label></td>
                                        <td><input type="text" class="form-control" placeholder=""></td>
                                    </tr>
                                    <tr class="form-group">
                                        <td><label for="">ログインID</label><span class="required">必須</span></td>
                                        <td><input type="text" class="form-control" placeholder=""></td>
                                    </tr>
                                    <tr class="form-group">
                                        <td><label for="">ログインパスワード</label><span class="required">必須</span></td>
                                        <td><input type="text" class="form-control" placeholder=""></td>
                                    </tr>
                                    <tr class="form-group">
                                        <td><label for="">ログインパスワード（確認）</label><span class="required">必須</span></td>
                                        <td><input type="text" class="form-control" placeholder=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end .col-sm-8 -->
                        <div class="col-sm-5">
                            <div class="text-center mgt-30">
                                <div class="avatardiv">
                                    <img id="avatar-view" src="../assets/images/fa-avatar.png" alt="">
                                </div>
                            </div>
                            <div class="mgt-30">
                                <div class="inputfile">
                                    <input type="text" id="filenamed">
                                    <span>選択する</span>
                                    <input class="hidefile" type="file" data-showname="filenamed" data-view="avatar-view" name="">
                                </div>
                            </div>
                        </div>
                        <!-- end .col-sm-3 -->
                    </div> <!-- end .row -->
                    <div class="row">
                    	<div class="col-xs-12">
                    		<div class="text-center">
                    			<button type="submit" onclick="window.location.href='account.php';" class="btn btn-primary">登録する</button>
                    			<button type="button" class="btn btn-default">戻る</button>
                    		</div>
                    	</div>
                    </div>

                    <!-- end .row -->
                </form>
                <!-- end form -->
            </div>
            <!-- end .container -->
        </main>
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
        <script src="../assets/js/luu.js"></script>
    </body>
</html>