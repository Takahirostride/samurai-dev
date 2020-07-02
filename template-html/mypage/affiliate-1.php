<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">アフィリエイト管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">アフィリエイト管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-10 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav nav-tabs tablinksub bordernone">
						    <li class="active">
						        <a href="mypage/affiliate-1.php">リンク作成</a>
						    </li>
						    <li>
						        <a href="mypage/affiliate-2.php">リンク作成</a>
						    </li>
						    <li>
						        <a href="mypage/affiliate-3.php">登録情報</a>
						    </li>
						</ul><!-- end .tablinksub -->
					</div><!-- end .col-sm-12 -->
					<div class="col-sm-12">
						<form action="" method="POST">
							<table class="table table-bordered tableformtitle">
								<tbody>
									<tr>
										<th>アフィリエイトコード</th>
										<td>https://samurai-match.jp/register_affiliate/125/</td>
									</tr>
								</tbody>
							</table>
							<table class="table table-bordered tableformtitle">
								<tbody id="affiliate-tbody">
									<tr>
										<th>区分</th>
										<td>
											<div class="radio-inline col-sm-3">
											  	<label>
											    	<input type="radio" class="radiochange" name="group" value="0" checked>バナー
											  	</label>
											</div>
											<div class="radio-inline col-sm-3">
											  	<label>
											    	<input type="radio" class="radiochange" name="group" value="1">テキスト
											  	</label>
											</div>
											<div class="radio-inline col-sm-3">
											  	<label>
											    	<input type="radio" class="radiochange" name="group" value="2">自由テキスト
											  	</label>
											</div>
										</td>
									</tr>
									<tr>
										<th>リンク先のURL</th>
										<td>https://samurai-match.jp/register_affiliate/125/</td>
									</tr>
									<tr class="change-aj">
										<th rowspan="2">表示バナー</th>
										<td>
											<div class="radio-inline col-sm-3">
											  	<label>
											    	<input type="radio" class="radiochange" name="group1" value="0" checked>企業向け
											  	</label>
											</div>
											<div class="radio-inline col-sm-3">
											  	<label>
											    	<input type="radio" class="radiochange" name="group1" value="1">士業向け
											  	</label>
											</div>
										</td>
									</tr>

									<tr class="change-aj">
										<td>
											<p>300X250</p>
											<div class="row">
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/rectmid.jpg" alt="">
												</div>
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/rectmid.jpg" alt="">
												</div>
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/rectmid.jpg" alt="">
												</div>
											</div>
											<p>300X280</p>
											<div class="row">
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/rectbig.jpg" alt="">
												</div>
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/rectbig.jpg" alt="">
												</div>
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/rectbig.jpg" alt="">
												</div>
											</div>
											<p>320X100</p>
											<div class="row">
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/mobile.jpg" alt="">
												</div>
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/mobile.jpg" alt="">
												</div>
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/mobile.jpg" alt="">
												</div>
											</div>
											<p>300X600</p>
											<div class="row">
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/half.jpg" alt="">
												</div>
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/half.jpg" alt="">
												</div>
												<div class="col-sm-4">
													<img class="thumbnail" src="assets/images/half.jpg" alt="">
												</div>
											</div>
											<p>728X90</p>
											<div class="row">
												<div class="col-sm-12">
													<img class="thumbnail" src="assets/images/big.jpg" alt="">
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="text-center mgbt-30">
								<button type="submit" class="shadowbuttonsuccess btn btn-success">コード作成</button>
							</div>
							<table class="table table-bordered tableformtitle">
								<tbody>
									<tr>
										<th>HTMLコード</th>
										<td>
											<textarea name="content" class="form-control" rows="5"></textarea>
										</td>
									</tr>
								</tbody>
							</table>
						</form>
					</div><!-- end .col-sm-12 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>

<?php include ('../inc/footer.php'); ?>
<script>
	$(document).on('change', '.radiochange', function(){
		var group = $('.radiochange[name="group"]:checked').val();
		var group1 = $('.radiochange[name="group1"]:checked').val();
		if(!group) group=0;
		if(!group1) group1=0;
		$.ajax({
			url: 'mypage/affiliate-ajax.php?group='+group+'&group1='+group1,
			dataType: 'html',
			success: function(html) {
				$('.change-aj').remove();
				$('#affiliate-tbody').append(html);
			}
		});
	});
	$(document).on('click', '.selectmessageitem', function(){
		var obj = $(this);
		obj.addClass('focusp');
		var str = '<a href="#">'+obj.text()+'</a>';
		$('#showaffli').html(str);

	});
</script>