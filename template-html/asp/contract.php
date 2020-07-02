<?php include ('./inc/header.php'); ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="bg-danger heading-text">契約者ページ</p>
                    </div>
                    <!-- end .col-sm-12 -->
                </div>
                <!-- end .row -->
                <form action=""  enctype="multipart/form-data">
                    <div class="row">
                    	<div class="col-xs-12">
                    		<p class="des">
	                            現在、企業が取得している補助金・助成金情報の一覧です。施策名をクリックすると、施策の詳細情報をみることができます。
	                        </p>
                    	</div>
                    	<div class="col-xs-12 contract-page">
                    		<div class="row">
                    			<div class="col-xs-12 col-sm-3">
                    				<div class="dbox">
                    					<a class="boxl" href="contract-export1.php"></a>
                    					<h3 class="dbox-title"><i class="fa fa-id-card"></i> 登録情報設定</h3>
                    					<p class="dbox-desc">ご契約内容を確認・変更する事ができます。</p>
                    				</div>
                    			</div>
                    			<div class="col-xs-12 col-sm-3">
                    				<div class="dbox">
                    					<a class="boxl" href="contract-export2.php"></a>
                    					<h3 class="dbox-title"><i class="fa fa-folder"></i> ご利用状況</h3>
                    					<p class="dbox-desc">各種サーピスの設定状況を確認・変更することができます。</p>
                    				</div>
                    			</div>
                    		</div> <!-- end .row -->
                    			
                    	</div> <!-- end .col-xs-12 -->
                        
                    </div> <!-- end .row -->
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