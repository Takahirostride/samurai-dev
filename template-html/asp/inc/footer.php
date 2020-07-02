	<footer class="bg-color">
	  <div class="container">
		<div class="row">
		  <div class="col-sm-3 col-xs-6">
			  <div class="item-list">
				<p class="title_list"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>  企業の皆様へ  </p>
				<ul class="link-list">
				  <li><a href="">士業ブログ</a></li>
				</ul>
			  </div>
		  </div>
		  <div class="col-sm-3 col-xs-6">
			  <div class="item-list">
				<p class="title_list"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>  士業の皆様へ  </p>
				<ul class="link-list">

				</ul>
			  </div>
		  </div>

		  <div class="col-sm-3 col-xs-6">
			  <div class="item-list">
				<p class="title_list"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>サポート  </p>
				<ul class="link-list">
				  <li><a href="">利用規約</a></li>
				  <li><a href="">特定商取引法に基づく表記</a></li>
				  <li><a href="">仕事依頼ガイドライン</a></li>
				  <li><a href="">プライバシーポリシー</a></li>
				</ul>
			  </div>
		  </div>
		  <div class="col-sm-3 col-xs-6">
			  <div class="item-list">
				<p class="title_list"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i>会社情報  </p>
				<ul class="link-list">
				  <li><a href="">会社概要</a></li>
				</ul>
			  </div>
		  </div>
		  
		  
		</div>
		<div class="row">
		  <div class="col-sm-12">
			<p class="copyright text-center">&copy; SAMURAI All Rights Reserved. 日本最大級の助成金・補助金マッチング「サムライ」</p>
		  </div>
		</div>
	  </div>
	</footer>
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugins/datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="assets/plugins/bar-rating/dist/jquery.barrating.min.js"></script>
	<script src="assets/js/common.js"></script>
	<script src="assets/js/luu.js"></script>
	<script>
		$('#example-fontawesome,.datrating').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });
        $('.rating-disable').barrating({
			//index page jubotron
            theme: 'fontawesome-stars',
            showSelectedRating: false,
            readonly: true,
            onSelect: function(value, text, event) {
			    if (typeof(event) !== 'undefined') {
			      // rating was selected by a user
			      console.log(value);
			    } else {
			      // rating was selected programmatically
			      // by calling `set` method
			    }
			  }
        });

		//agency/home tooltip
		$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		})
	</script>
  </body>
</html>