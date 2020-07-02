<?php include ('./inc/header.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="bg-danger heading-text">グループ</p>
                    </div>
                    <!-- end .col-sm-12 -->
                </div>
                <!-- end .row -->
                <form action=""  enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-7">
                            <legend>グループ作成</legend>
                            <table class="table form-bor middle">
                                <tbody>
                                    <tr class="form-group">
                                        <td><label for="">グループ名</label><span class="required">必須</span></td>
                                        <td>
                                            <input type="text" class="form-control" placeholder="">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end .row -->
                    <div class="row">
                    	<div class="col-xs-7">
                    		<div class="text-center">
                    			<button type="submit" onclick="window.location.href='group.php';" class="btn btn-primary">登録する</button>
                    			<button type="button" class="btn btn-default">戻る</button>
                    		</div>
                    	</div>
                    </div><!-- end .row -->
                    <div class="row">
                        <div class="col-xs-7">
                            <legend>グループ参加者</legend>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="displaytb">
                                        <div class="boxlinksmall text-center">
                                            <img class="smallimg" src="../assets/images/fa-avatar.png" alt="">
                                            
                                        </div>
                                    </div>
                                    <!-- end .boxlink -->
                                </div>
                                <div class="col-sm-3">
                                    <div class="displaytb">
                                        <div class="boxlinksmall text-center">
                                            <img class="smallimg" src="../assets/images/fa-avatar.png" alt="">
                                            
                                        </div>
                                    </div>
                                    <!-- end .boxlink -->
                                </div>
                                <div class="col-sm-3">
                                    <div class="displaytb">
                                        <div class="boxlinksmall text-center">
                                            <img class="smallimg" src="../assets/images/fa-avatar.png" alt="">
                                            
                                        </div>
                                    </div>
                                    <!-- end .boxlink -->
                                </div>
                                <div class="col-sm-3">
                                    <div class="displaytb">
                                        <div class="boxlinksmall text-center">
                                            <img class="smallimg" src="../assets/images/fa-avatar.png" alt="">
                                            
                                        </div>
                                    </div>
                                    <!-- end .boxlink -->
                                </div>
                            </div> <!-- end .row -->
                            <div class="row">
                                <div class="col-xs-6 col-xs-offset-3">
                                    <div class="input-group search-btn-gr">
                                        <input type="text" class="form-control" placeholder="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button">検索する</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    
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