<?php include ('./inc/header2.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="com-hd">株式会社サムライ　様</p>
                        <div class="step-div">
                            <span class="" onclick="window.location.href='company_add_step1.php';">基本情報</span>
                            <span class="" onclick="window.location.href='company_add_step2.php';">助成金・補助金情報</span>
                            <span class="active">党則・利用状況</span>
                            <span class="" onclick="window.location.href='company_add_step4.php';">資料</span>
                        </div>
                        <p>現在、企業が取得している助成金・補助金情報の一覧です。施策名をクリックすると、施策の詳細情報をみることができます。</p>
                        <div class="row">
                            <p class="com-hd">登録状況</p>

                            <div class="col-xs-12">
                                <table class="table table-bordered com-table">
                                    <thead>
                                        <tr>
                                            <th width="20%">送信日</th>
                                            <th>内容</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>平成 30 年 5月 12日</td>
                                            <td><a href="company_detail.php">株式会社サムライ</a></td>
                                        </tr>
                                        <tr>
                                            <td>平成 30 年 5月 12日</td>
                                            <td><p class="text-danger">SAMURAI</p></td>
                                        </tr>
                                    </tbody>
                                </table> 
                                <div class="btn-right-mail">
                                    <a class="btn-add pull-right" href="#" onclick="return false;">
                                        <i class="fa fa-envelope"></i><span>登録メール送信</span>
                                    </a>
                                </div>
                                <p class="com-hd">利用状況</p>
                                <table class="table table-bordered com-table">
                                    <thead>
                                        <tr>
                                            <th width="20%">送信日</th>
                                            <th>内容</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>平成 30 年 5月 12日</td>
                                            <td><a href="company_detail.php">株式会社サムライ</a></td>
                                        </tr>
                                        <tr>
                                            <td>平成 30 年 5月 12日</td>
                                            <td><a href="company_detail.php">株式会社サムライ</a></td>
                                        </tr>
                                        <tr>
                                            <td>平成 30 年 5月 13日</td>
                                            <td><a href="company_detail.php">株式会社サムライ</a></td>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div> <!-- end .col-xs-12 -->
                        </div> <!-- end .row -->

                        
                    </div> <!-- end .col-xs-12 -->
                </div> 
                <!-- end .row -->
            </div>
            <!-- end .container -->
        </main>
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../assets/plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>

    </body>
</html>