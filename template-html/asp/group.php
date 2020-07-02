<?php include ('./inc/header.php'); ?>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="bg-danger heading-text">グループ設定</p>
                    </div>
                    <!-- end .col-sm-12 -->
                </div>
                <!-- end .row -->
                <div class="row">
                    <div class="col-sm-8">
                        <p class="des">
                            現在、企業が取得している補助金・助成金情報の一覧です。施策名をクリックすると、施策の詳細情報をみることができます。
                        </p>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="gdbox">
                                    <a href="group_edit.php"><i class="fa fa-store"></i></a>
                                    <p class="gdbox-desc">本店</p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="gdbox">
                                    <a href="group_edit.php"><i class="fa fa-users"></i></a>
                                    <p class="gdbox-desc">東京本店</p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="gdbox">
                                    <a href="group_edit.php"><i class="fa fa-store"></i></a>
                                    <p class="gdbox-desc">横浜本店</p>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="gdbox">
                                    <a href="group_edit.php"><i class="fa fa-users"></i></a>
                                    <p class="gdbox-desc">大阪本店</p>
                                </div>
                            </div>
                        </div> <!-- end .row -->
                    </div>
                    <!-- end .col-sm-8 -->
                    <div class="col-sm-4">
                        <a class="btn-add pull-right" href="group_edit.php">
                          <i class="fa fa-plus"></i><span>追加する</span>
                        </a>
                    </div>
                    <!-- end .col-sm-3 -->
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