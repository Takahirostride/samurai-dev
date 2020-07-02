<?php include ('./inc/header_nologin.php'); ?>
<div class="container">
	<p>select</p>
	<div class="angularsl">
		<select name="filteryear">
            <option value="1" selected="selected">すべて</option>
            <option value="2">葛飾区三</option>
            <option value="3">横浜市</option>
            <option value="4">新事業</option>
            <option value="5">中小企</option>
            <option value="6">トライア</option>
            <option value="7">産業立</option>
            <option value="8">平成３０年</option>
            <option value="9">横浜市中</option>
            <option value="10">山形県元</option>
        </select>
    </div>
    <p>multi select</p>
    <div id="divajax">
	    <div class="angularsl">
			<select name="filteryear[]" multiple="">
	            <option value="1">すべて</option>
	            <option value="2">葛飾区三</option>
	            <option value="3">横浜市</option>
	            <option value="4">新事業</option>
	            <option value="5">中小企</option>
	            <option value="6">トライア</option>
	            <option value="7">産業立</option>
	            <option value="8">平成３０年</option>
	            <option value="9">横浜市中</option>
	            <option value="10">山形県元</option>
	        </select>
	    </div>
	</div>
	<button type="button" onclick="getajax()" class="shadowbuttonprimary btn btn-primary">ajax change select</button>
	<p>button1</p>
	<div class="box">
		<a type="button" class="shadowbuttonblue btn btn-primary btn-lg land-btn">ログイン</a>
		<a type="button" class="shadowbuttonwarm btn btn-warning btn-lg land-btn">新規登録</a>
	</div> <br> <br>
	<div class="box">
		<a href="#" class="shadowbuttonprimary btn btn-primary">ログイン</a>
		<a href="#" class="shadowbuttonwarning btn btn-warning">新規登録</a>
		<a href="#" class="shadowbuttoninfo btn btn-info">新規登録</a>
		<a href="#" class="shadowbuttondanger btn btn-danger">新規登録</a>
		<a href="#" class="shadowbuttonsuccess btn btn-success">新規登録</a>
	</div>


	<p>h tag</p>
	<div class="box">
		<h2 class="page-title">第5条　会員資格の取消等<button type="button" class="btn-primary btn btn-style-shadow-green btn-success right-title">表示する</button></h2>
		<h2 class="page-title">第5条　会員資格の取消等</h3>
		<h3 class="page-title">第5条　会員資格の取消等</h3>
		
		<h4 class="left-border text-color font16">実績サマリー</h4>
		<h3 class="index-box-title">
			士業のブログ
			<small>SAMURAIを活用頂いている士業のブログを紹介します。</small>
		</h3>
		<h3 class="login-box-title">
			ログインする  
			<small>会員登録がお済みてない方は、<a href="#">こちら</a>から無料会員登録してください。</small>
		</h3>
		<p class="adverti-title">SAMURAIへの広告出稿の募集</p>
	</div> 
	<div class="text-center">
		<div class="div-style-blue ">
			<div class="imagecenter">
				<img src="assets/images/img1.jpg" class="img-thumbnail">
			</div>
			<h3 class="ng-binding">○○（<b>表示名</b>）</h3>
			<h3 class="ng-binding">○○（<strong>ユーザー名</strong>）</h3>
		</div>
		<p><button type="button" class="btn btn-default sidebar-btn btn-grad active">
			<strong>active</strong>

		</button></p>

		<p><button type="button" class="btn btn-default sidebar-btn btn-grad">
			<strong>button sidebar</strong>
		</button></p>

		<a href="#" class="btn btn-default sidebar-btn btn-grad active">tag a</a>
	</div>
	<p>blog list</p>
	<div class="row">
					<div class="col-sm-4">
						<div class="box-item">
							<img src="assets/images/bloglist-post-01.jpg" alt="">
							<div class="pd-20">
								<p class="title-list"><strong>士業名士業名士業名</strong> <span class="float-right">○○年○○月○○日</span></p>
								<h5 class="blog-title"><strong>タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</strong></h5>
								<p>テキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテ</p>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="box-item">
							<img src="assets/images/bloglist-post-01.jpg" alt="">
							<div class="pd-20">
								<p class="title-list"><strong>士業名士業名士業名</strong> <span class="float-right">○○年○○月○○日</span></p>
								<h5 class="blog-title"><strong>タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</strong></h5>
								<p>テキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテ</p>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="box-item">
							<img src="assets/images/bloglist-post-01.jpg" alt="">
							<div class="pd-20">
								<p class="title-list"><strong>士業名士業名士業名</strong> <span class="float-right">○○年○○月○○日</span></p>
								<h5 class="blog-title"><strong>タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</strong></h5>
								<p>テキストテキストテキストテキストテキテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテ</p>
							</div>
						</div>
					</div>
				</div>
	<p>pagination</p>
	<nav class="text-center" aria-label="pagination">
	  	<ul class="pagination">
		    <li class="page-item disabled">
		      <a class="page-link" href="#" tabindex="-1">最初</a>
		    </li>
		    <li class="page-item"><a class="page-link" href="#">1</a></li>
		    <li class="page-item"><a class="page-link" href="#">2</a></li>
		    <li class="page-item"><a class="page-link" href="#">3</a></li>
		    <li class="page-item"><a class="page-link" href="#">4</a></li>
		    <li class="page-item"><a class="page-link" href="#">5</a></li>
		    <li class="page-item"><a class="page-link" href="#">...</a></li>
		    <li class="page-item"><a class="page-link" href="#">20</a></li>
		    <li class="page-item"><a class="page-link" href="#">...</a></li>
		    <li class="page-item"><a class="page-link" href="#">30</a></li>

		    <li class="page-item">
		      <a class="page-link" href="#">最後</a>
		    </li>
	  	</ul>
	</nav>
	<p>checkbox</p>
	<div class="form-group mgtb-20">
	    <div class="col-sm-offset-3 col-sm-9">
	      <div class="checkbox">
	        <label>
	          <input type="checkbox"><a href="#">利用規約</a>に同意する 
	        </label>
	      </div>
	    </div>
	</div>
	<div class="form-group mgtb-20">
	    <div class="col-sm-offset-3 col-sm-5">
	      <button type="submit" class="btn submitbutton form-control ">アカウントを登録する(無料)</button>
	    </div>
  	</div>
<div class="clearfix"></div>
  	<div class="boxpdbg">
		<table class="table table-bordered table-hover pdtdbold">
		    <thead>
			    <tr>
			        <th>タイトル</th>
			        <th>事業者名</th>
			        <th>マッチング日</th>
			        <th>締切日</th>
			    </tr>
		    </thead>
		    <tbody>
			    <tr>
			        <td>伊勢崎市企業立地促進奨励金（施策名）</td>
			        <td>テスト</td>
			        <td>2018年07月26日</td>
			        <td>0000年00月00日</td>
			    </tr>
		    </tbody>
		</table>
		<table class="table table-bordered table-hover pdtdbold">
		    <tbody>
			    <tr>
			        <td>
			        	<div class="pull-left">
			        		<a href="#" class="shadowbuttonsuccess btn btn-success mgr-8">タスク設定</a>
			        		<a href="#" class="shadowbuttonsuccess btn btn-success mgr-8">タスクを見る</a>
			        		<a href="#" class="shadowbuttonsuccess btn btn-success">メッセージを見る</a>
			        	</div>
			        	<div class="pull-right">
			        		<a href="#" class="shadowbuttonprimary btn btn-primary mgr-8">請求</a>
			        		<a href="#" class="shadowbuttonprimary btn btn-primary">完了・キャンセル</a>
			        	</div>
			        </td>
			    </tr>
			    <tr>
			        <td><span class="span-date">2018年09月28日</span>タスク：支払</td>
			    </tr>
			    <tr>
			        <td><span class="span-date">2018年08月31日</span>タスク：書類完成日 , 受給申請</td>
			    </tr>
			    <tr>
			        <td><span class="span-date">お知らせ</span></td>
			    </tr>
		    </tbody>
		</table>
	</div>
<div class="div-suggestion-policy">
					<div class="row">
						<div class="col-sm-12">
						    <form action="" method="POST" class="form-inline">
					    		<div class="form-group col-sm-10">
					    			<label class="lbangularsl" for="">表示年月：</label>
					    			<div class="angularsl pull-left">
						    			<select class="mgl-15" name="filteryear">
							                <option value="" selected="selected">すべて</option>
							                <option value="葛飾区三年以内既卒者等採用定着コース奨励金">葛飾区三年以内既卒者等採用定着コース奨励金</option>
							                <option value="横浜市 IoT 導入スタートアップ補助金">横浜市 IoT 導入スタートアップ補助金</option>
							                <option value="新事業育成資金(新企業育成貸付)">新事業育成資金(新企業育成貸付)</option>
							                <option value="中小企業海外展開チャレンジ（終了">中小企業海外展開チャレンジ（終了</option>
							                <option value="トライアルユース補助事業">トライアルユース補助事業</option>
							                <option value="産業立地資金（本社機能・支社機能・ホテル）">産業立地資金（本社機能・支社機能・ホテル）</option>
							                <option value="平成３０年度創業セミナー">平成３０年度創業セミナー</option>
							                <option value="横浜市中小企業融資制度">横浜市中小企業融資制度</option>
							                <option value="山形県元気な６次産業化ステップアップ支援事業（スモールビジネス創出支援事業）２次募集">山形県元気な６次産業化ステップアップ支援事業（スモールビジネス創出支援事業）２次募集</option>
							            </select>
						            </div>
					    		</div>
					    		<div class="form-group col-sm-2 text-right">
									<a href="#" class="shadowbuttonprimary btn btn-primary">提案一覧を見る</a>
					            </div>

					    	</form>
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered table-hover table-myjob">
						    <thead>
							    <tr>
							        <th>日時</th>
							        <th>タイトル</th>
							        <th>事業者名</th>
							        <th>メッセージ</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>

							        <td>○○年○○月○○日</td>
							        <td>○○○○（施策名）</td>
							        <td>○○件の質問</td>
							        <td class="td-link"><a href="#">設定・編集・掲載終了</a></td>
							    </tr>
						    </tbody>
						</table>
					</div>
				</div><!-- end .row -->
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered table-hover table-myjob">
						    <thead>
							    <tr>
							        <th>設定履歴</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td><span class="span-date">○○年○○月○○日</span>助け舟を登録しました。</td>
							    </tr>
							    <tr>
							        <td><span class="span-date">○○年○○月○○日</span>助け舟を登録しました。</td>
							    </tr>
							    <tr>
							        <td><span class="span-date">○○年○○月○○日</span>助け舟を登録しました。</td>
							    </tr>
							    <tr>
							        <td><span class="span-date">○○年○○月○○日</span>助け舟を登録しました。</td>
							    </tr>
						    </tbody>
						</table>
					</div>
				</div><!-- end .row -->
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered table-hover table-myjob">
						    <thead>
							    <tr>
							        <th>掲載設定</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-8">募集の必要がなくなった場合、掲載をキャンセルしてください。</div>
								        	<div class="col-sm-4 text-center"><a href="#" class="shadowbuttonsuccess btn btn-success">新規登録</a></div>
							        	</div>
							        </td>
							    </tr>
							    <tr>
							    	<td>
								    	<div class="row">
								        	<div class="col-sm-8">掲載が終了、掲載をキャンセルした案件を再度募集する場合は、再度掲載を行ってください。</div>
								        	<div class="col-sm-4 text-center"><a href="#" class="shadowbuttonsuccess btn btn-success">再度掲載</a></div>
							        	</div>
							        </td>
							    </tr>
						    </tbody>
						</table>
					</div>
				</div><!-- end .row -->
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-bordered mgt-30">
						    <thead class="div-style-blue2">
							    <tr>
							        <th>ご依頼を不特定多数の方へみられたくない方へ</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-10">
								        		<div class="checkbox">
								        			<label class="text-primary"><input type="checkbox"><strong>完全非公開オプション</strong></label>
								        		</div>
								        		<p>
								        			依頼を非公開にして提案を募集することができます。<br>
													募集中は士業とクライアント（法人）しか依頼を閲覧することができず、募集終了後には当選ユーザー及び依頼したクライアントのみ閲覧することができます。<br>
													※士業が依頼詳細ページを閲覧するには本人確認と機密保持確認が必須となります。
								        		</p>
								        	</div>
								        	<div class="col-sm-2 text-right">
								        		<span class="pricetext">+10,800円</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
							    <tr>
							        <td>
							        	<div class="row">
								        	<div class="col-sm-10">
								        		<div class="checkbox">
								        			<label class="text-primary"><input type="checkbox"><strong>非公開オプション</strong></label>
								        		</div>
								        		<p>
								        			依頼を非公開にして提案を募集することができます。（非公開オプションをつけていても、士業にログインすると、表示されてしまいます。予めご了承ください。）
								        		</p>
								        	</div>
								        	<div class="col-sm-2 text-right">
								        		<span class="pricetext">+5,400円</span>
								        	</div>
							        	</div>
							        </td>
							    </tr>
						    </tbody>
						</table><!-- end table -->
					</div>
				</div><!-- end .row -->
				<div class="row">
					<div class="col-sm-12">
						<h3 class="page-title">進歩状況</h3>
						<ul class="tallList">
							<li>
								<div class="text-center client-status-buttons">
									<a href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btn btn-primary">完了</button>
								</div>
							</li>
							<li>
								<div class="text-center agency-status-buttons">
									<a href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btn btn-primary">完了</button>
								</div>
							</li>
							<li>
								<div class="text-center country-status-buttons">
									<a href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btn btn-primary">完了</button>
								</div>
							</li>
							
							<li>
								<div class="text-center client-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center agency-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center country-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>

							<li>
								<div class="text-center client-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center agency-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center country-status-buttons">
									<a class="active" href="#">
									05月 16日
								        <span></span>
								        書類完成日<br>
								    </a>
								    <button type="button" class="shadowbuttonprimary status-buttons btndisabled btn btn-primary">未完了</button>
								</div>
							</li>
							<li>
								<div class="text-center country-status-buttons">
								    <button type="button" class="shadowbuttonsuccess btn btn-success tallListend">未完了</button>
								</div>
							</li>
						</ul>
					</div>
				</div>

</div> 
<?php include ('./inc/footer.php'); ?>

<script>
	function getajax() {
		$.ajax({
		    url: 'selectajax.php',
		    data: {id:1},
		    dataType: 'text',
		    complete : function(){
		        
		    },
		    success: function(data){
		    	$('#divajax').html(data);
		    	setupselect();
		    }
		});
	}
	
</script>