<?php include ('./inc/header2.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="uname-admin">山田様</p>
                        <ul class="masteslist nolisttt text-center">
                            <li>
                                <div class="boxlink2">
                                    <p class="">
                                        <i class="fa fa-file-contract"></i>
                                    </p>
                                    <p>
                                       企業検索 
                                    </p>
                                    <a href="staff.php"></a>
                                </div> 
                                <!-- end .boxlink -->
                            </li>
                            <li>
                                <div class="boxlink2">
                                    <p class="">
                                        <i class="fa fa-file-signature"></i>
                                    </p>
                                    <p>
                                       施策検索 
                                    </p>
                                    <a href="find_policy.php"></a>
                                </div>
                                <!-- end .boxlink -->
                            </li>
                            <li>
                                <div class="boxlink2">
                                    <p class="">
                                        <i class="fa fa-check-circle"></i>
                                    </p>
                                    <p>
                                       samurai 登録 
                                    </p>
                                    <a href="register_samurai.php"></a>
                                </div>
                                <!-- end .boxlink -->
                            </li>
                            <li>
                                <div class="boxlink2">
                                    <p class="">
                                        <i class="fa fa-chart-pie"></i>
                                    </p>
                                    <p>
                                       samurai 分析 
                                    </p>
                                    <a href="samurai_analytics.php"></a>
                                </div>
                                <!-- end .boxlink -->
                            </li>
                            <li>
                                <div class="boxlink2">
                                    <p class="">
                                        <i class="fa fa-comment"></i>
                                    </p>
                                    <p>
                                       メッセージ 
                                    </p>
                                    <a href="message.php"></a>
                                </div>
                                <!-- end .boxlink -->
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                        <div>
                            <a href="index.php" class="btn-link"><i class="fa fa-redo-alt fa-3 mgr-15" aria-hidden="true"></i>管理者ページ</a>
                        </div>
                        <div class="clearfix"></div>

                        
                    </div>
                    <!-- end .col-sm-12 -->
                    <div class="col-sm-6">
                        <p class="bg-danger heading-text2">検索</p>
                        <form action="" method="POST" class="form-horizontal" role="form">
                        
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" class="form-control" aria-label="">
                                        <span class="input-group-btn">
                                            <button type="button" onclick="window.location.href='staff.php';" class="btn btn-default">企業検索</button>
                                        </span>
                                    </div>
                                </div>
                            </div> <!-- end .form-group -->
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input type="text" class="form-control" aria-label="">
                                        <span class="input-group-btn">
                                            <button type="button" onclick="window.location.href='policy.php';" class="btn btn-default">施策検索</button>
                                        </span>
                                    </div>
                                </div>
                            </div> <!-- end .form-group -->
                        
                        </form>
                        <!-- end .masteslist -->
                    </div><!-- end .col-sm-6 -->
                    <div class="col-sm-6">
                        <p class="bg-danger heading-text2">メッセージ</p>
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>送信者名</th>
                                    <th>内容</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>15:00</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>15:00</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>15:00</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>昨日</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>８月３日</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- end .masteslist -->
                    </div><!-- end .col-sm-6 -->
                    <div class="col-sm-6">
                        <p class="bg-danger heading-text2">施策新着情報</p>
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>施策名</th>
                                    <th>対象取引先</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- end .masteslist -->
                    </div><!-- end .col-sm-6 -->
                    <div class="col-sm-6">
                        <p class="bg-danger heading-text2">掲載終了日が近い施策</p>
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>施策名</th>
                                    <th>対象取引先</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- end .masteslist -->
                    </div><!-- end .col-sm-6 -->
                    <div class="col-xs-12">
                        <p class="bg-danger heading-text2">提案できる取引先情報</p>
                        <p class="table-hd">新着の補助金・助成金</p>
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>対象取引先</th>
                                    <th>対象取引先</th>
                                    <th>施策名</th>
                                    <th>施策名</th>
                                    <th>施策名</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                                <tr>
                                    <td>◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                    <td>◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯◯</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
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