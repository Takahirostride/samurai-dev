<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">各種認証申請</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">各種認証申請</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-8 mainpage">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="tab-profile nav nav-tabs nav-justified">
                            <li class="tab-style-grey active"><a href="mypage/authentication-1.php">本人確認書類</a></li>
                            <li class="tab-style-grey"><a href="mypage/authentication-2.php">機密保持確認</a></li>
                            <li class="tab-style-grey"><a href="mypage/authentication-3.php">事務局確認</a></li>
                            <li class="tab-style-grey"><a href="mypage/authentication-4.php">電話確認</a></li>
                            <li class="tab-style-grey not-text"><a href="mypage/clientprofile-7.php"><img src="assets/images/manual.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p class="note-text"><i class="fa fa-check"></i>本人確認書類を送信しました。</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <h3>本人確認書類</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <h3 class="page-title">本人確認書類</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p>本人書類確認をご提出後、SAMURAI事業部より確認作業を行います。確認が完了するまでおお時間がかかる場合がございますが、ご了承願います。
                        確認が完了次第、メールにてご連絡させていただきます。</p>
                        <div class="step">
                            <div class="col-sm-3"><p>プロフィール編集</p></div>
                            <div class="col-sm-3"><p>資料提出</p></div>
                            <div class="col-sm-3"><p>資料確認</p></div>
                            <div class="col-sm-3"><p>資料確認</p></div>
                        </div>
                        <form method="post" action="/authentication">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="div-style-blue2 ">氏名</td>
                                    <td>
                                        <input type="text" name="name" class="form-control">
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="div-style-blue2 ">住所</td>
                                    <td>
                                        <input type="text" name="address" class="form-control">
                                    </td>
                                </tr> 
                                <tr>
                                    <td class="div-style-blue2 ">生年月日</td>
                                    <td class="authentication-1-1">
                                        
                                            <div class="col-sm-2 pdl-0 pdlr-sp-0">
                                                <div class="form-group has-feedback">
                                                <input type="text" name="year" class="form-control">
                                                <span class="form-control-feedback">年</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 pdlr-sp-0">
                                                <div class="form-group has-feedback">
                                                <input type="text" name="day" class="form-control">
                                                <span class="form-control-feedback">日</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-2 pdlr-sp-0">
                                                <div class="form-group has-feedback">
                                                <input type="text" name="mon" class="form-control">
                                                <span class="form-control-feedback">月</span>
                                                </div>
                                            </div>
                                    </td>
                                </tr> <tr>
                                    <td class="div-style-blue2 ">添付ファイル</td>
                                    <td >
                                        <div id="box-file">
                                            <div class="input-group form-group" id="del1">
                                                <input type="text" class="form-control " aria-invalid="false" name="profile-image-text">
                                                <div class="input-group-btn">
                                                    <label class="del-file" data-del="del1"><span><i class="fa fa-trash-o"></i></span></label>
                                                    <label for="attachment1" class="btn btn-primary">参照</label>
                                                    <input id="attachment1" type="file" class="ds-none" name="profile-image-file" accept="image/*">
                                                </div>
                                            </div>
                                        </div>   
                                        <p class="mgt-20"><span id="add-box-file"><i class="fa fa-plus-circle"></i>ファイルを追加する</span></p>
                                        <p class="mgt-20"><label><input type="checkbox" name="option1">登録氏名が漢字・かな・ローマ字表記も含め証明書類と一致している</label></p>
                                        <p><label><input type="checkbox" name="option1">登録住所が番地・部屋番号まで証明書類と一致している</label></p>
                                    </td>
                                </tr>
                            </table>
                            <p><input type="submit" class="btn btn-style-shadow-green btn-success" style="margin-top: 40px;margin-bottom: 50px" ng-click="clickverifydocument()" value="送信する" >
                            </p>
                        </form>
                    </div>
                </div>

			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>
<script type="text/javascript">
    $(document).delegate(".del-file","click", function() {
        var id_del = $(this).attr("data-del");
        console.log("s");
        $("#"+id_del).remove();
    });
    $("#add-box-file").click(function(){
        var id = get_id();
        var text = '<div class="input-group form-group" id="'+id+'"><input type="text" class="form-control " aria-invalid="false" name="profile-image-text3"><div class="input-group-btn"><label class="del-file" data-del="'+id+'"><span><i class="fa fa-trash-o"></i></span></label><label for="attachment4" class="btn btn-primary">参照</label><input id="attachment4" type="file" class="ds-none" name="profile-image-file3" accept="image/*"></div></div>';
        $("#box-file").append(text);

    });
    function ramdom_number(min, max){
        return Math.floor(Math.random() * (max - min)) + min;
    }
    function get_id(){
        number_id = ramdom_number(0, 100);
        if( $('#del'+number_id).length ){
            get_id();
        }else{
            return "del"+number_id;
        }
    }
</script>
