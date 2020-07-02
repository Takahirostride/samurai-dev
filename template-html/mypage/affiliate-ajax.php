<?php 
	if($_GET['group']==0 || $_GET['group']==1) : ?>
		<tr class="change-aj">
			<th rowspan="2">表示バナー</th>
			<td>
				<div class="radio-inline col-sm-3">
				  	<label>
				    	<input type="radio" class="radiochange" name="group1" value="0" <?php if($_GET['group1']==0) echo 'checked'; ?>>企業向け
				  	</label>
				</div>
				<div class="radio-inline col-sm-3">
				  	<label>
				    	<input type="radio" class="radiochange" name="group1" value="1" <?php if($_GET['group1']==1) echo 'checked'; ?>>士業向け
				  	</label>
				</div>
			</td>
		</tr>
<?php endif; ?>
<?php if($_GET['group']==2) : ?>
		<tr class="change-aj">
			<th>テキスト</th>
			<td>
				<textarea class="form-control" rows="5" name="preview"></textarea>
			</td>
		</tr>
	
<?php endif; ?>
<?php if($_GET['group']==0) : ?> ?>
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
<?php  
	endif;
	if($_GET['group']==1 && $_GET['group1']==0) : ?>
?>
		<tr class="change-aj">
			<td>
				<p class="selectmessageitem">助成金・補助金自動マッチングサイト「SAMURAI」</p>
				<p class="selectmessageitem">助成金・補助金自動マッチングサイト「SAMURAI」　登録無料</p>
				<p class="selectmessageitem">取得できる助成金・補助金がすぐにわかる「SAMURAI」</p>
				<p class="selectmessageitem">助成金・補助金マッチングサイト「サムライ」に登録しませんか？</p>
				<p class="selectmessageitem">助成金・補助金簡単取得</p>
				<p class="selectmessageitem">助成金・補助金申請代行者の３者マッチング</p>
			</td>
		</tr>	
		<tr class="change-aj">
			<th>プレビュー</th>
			<td id="showaffli">

			</td>
		</tr>	
<?php  
	endif;
	if($_GET['group']==1 && $_GET['group1']==1) : ?>
?>
		<tr class="change-aj">
			<td>
				<p class="selectmessageitem">助成金・補助金自動マッチングサイト「SAMURAI」</p>
				<p class="selectmessageitem">助成金・補助金自動マッチングサイト「SAMURAI」　登録無料</p>
				<p class="selectmessageitem">取得できる助成金・補助金がすぐにわかる「SAMURAI」</p>
				<p class="selectmessageitem">助成金・補助金マッチングサイト「サムライ」に登録しませんか？</p>
				<p class="selectmessageitem">助成金・補助金簡単取得</p>
				<p class="selectmessageitem">助成金・補助金申請代行者の３者マッチング</p>
			</td>
		</tr>	
		<tr class="change-aj">
			<th>プレビュー</th>
			<td id="showaffli">
				
			</td>
		</tr>
<?php  
	endif;
	die();
?>