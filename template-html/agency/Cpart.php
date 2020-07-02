<?php include ('../inc/header.php'); ?>
<?php 
$cat = array(
	1 => '雇用・人材',
	2 => '経営改善・販路開拓',
	3 => '設備導入・研究開発',
	4 => '創業・起業',
	5 => '経営環境改善',
	6 => '特許・知的財産',
	7 => '誘致関連',
);
$subcat = array(
	1 => array(
		8 => 'subcat1-1',
		9 => 'subcat1-2',
		10 => 'subcat1-3',
	),
	2 => array(
		11 => 'subcat2-1',
		12 => 'subcat2-2',
	),
	3 => array(
		13 => 'subcat3-1',
		14 => 'subcat3-2',
	),
	4 => array(
		15 => 'subcat4-1',
	),
	5 => array(
		17 => 'subcat5-1',
		18 => 'subcat5-2',
	),
	6 => array(
		19 => 'subcat6-1',
	),
	7 => array(
		21 => 'subcat7-1',
		22 => 'subcat7-2',
	),
);
$data = array(
	'category'	=>	$cat,
	'sub_category'	=>	$subcat
);
//echo json_encode($data);
?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php include ('../inc/breadcrumb.php'); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">助成金・補助金の検索</h1>
				<p class="page-description">各省庁が公開している助成金・補助金の手動検索が行えます。手動検索を行い、対応可能な助成金・補助金を増やすことで、依頼数が増えます。</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<h3 class="mpage-title">リスト一覧</h3>
				<p><a href="#" class="btn btn-default sidebar-btn btn-grad active">
						<strong>提案を検討リスト</strong>
					</a></p>
				<p><a href="#" class="btn btn-default btn-grad sidebar-btn">
						<strong>興味リスト</strong>
					</a></p>
				<p><a href="#" class="btn btn-default btn-grad sidebar-btn">
						<strong>非表示リスト</strong>
					</a></p>
			</div> <!-- end .sidebar-left -->

			<div class="col-sm-10 mainpage">
			    <div class="col-sm-12 div-style-blue2 ">
			        <div class="row">     
			            <div class="col-sm-11">
				            <label> 
				                <input class="control-label" type="radio" id="option1" name="addway" checked=""> 登録されている施策の中から選択する  
				            </label>
				            <br> 
				            <label> 
				                <input class="control-label" type="radio" id="option2" name="addway" value="2">SAMURAIに登録されていない施策を登録する        
				            </label>
			            </div>
			            <div class="col-sm-1">
			       　　 		<img src="assets/images/manual.png" class="mb20" height="40px" data-toggle="modal" data-target="#modal-registration-policy1">
			            </div>
			        </div>
		        </div>
				<div class="row subsidy-list">
					<div class="col-sm-12">
					<form>
						<h4 class="pagerow-title">
							<span>カテゴリー</span>
						</h4>
						<table class="table table-bordered dtable table-condensed dcat-table">
							<tbody id="category-list">
								<tr>
									<td class="dthead" rowspan="3">&nbsp;</td>
									<td>
										<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="1" data-id="1">雇用・人材</label></div>
									</td>

									<td>
										<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="2" data-id="2">経営改善・販路開拓</label></div>
									</td>
									<td>
										<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="3" data-id="3">設備導入・研究開発</label></div>
									</td>
									<td>
										<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="4" data-id="4">創業・起業</label></div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="5" data-id="5">経営環境改善</label></div>
									</td>
									<td>
										<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="6" data-id="6">特許・知的財産</label></div>
									</td>
									<td>
										<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="7" data-id="7">誘致関連</label></div>
									</td>
									<td> &nbsp; </td>
								</tr>
								<tr>
									<td colspan="4" class="dright-el dbg-gray"><div class="checkbox"><label><input type="checkbox" value="bigcat" class="check_list_all">全選択</label></div></td>
								</tr>
							</tbody>
						</table> <!-- end table category -->
						<div id="subcategory-list">
							
						</div> <!-- end .subcat-disp -->

						<!-- table sub category -->

						<div class="clearfix"></div>
						<h4 class="pagerow-title">
							<span>対象地域</span>
						</h4>
						<div class="append-bsearch">
							<div class="row">
								<div class="col-xs-4">
									<div class="angularsl">
										<select class="selectpicker">
											<option value="1">全国</option>
											<option value="2">北海道</option>
										</select>
									</div> <!-- end .angularsl -->
								</div> <!-- end .col-xs-4 -->
								<div class="col-xs-4">
									<div class="angularsl">
										<select class="form-control" multiple="multiple">
											<option value="1">すべて</option>
											<option value="2">1札幌市</option>
											<option value="3" selected="selected">2札幌市</option>
											<option value="4" selected="selected">3札幌市</option>
										</select>
									</div> <!-- end .angularsl -->
								</div> <!-- end .col-xs-4 -->
								<div class="col-xs-4">
									
								</div> <!-- end .col-xs-4 -->

							</div> <!-- end .row -->
						</div> <!-- end .append-bsearch -->
						<div class="clearfix"></div>
						<a href="#" onclick="append_bsearch(); return false;" class="append-bsearch-link">複数選択をする</a>

						<div class="text-center bsearch-btn-s">
							<button type="submit" class="btn btn-success btn-style-shadow-green">検索する</button>
						       　<img src="assets/images/manual.png" height="40px" data-toggle="modal" data-target="#modal-registration-policy1">
						</div>

					</form>
					</div> <!-- end .div.col-sm-12 -->

				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>


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
  </div>
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
		});
		var append_bsearch = function() {
			html = '<div class="row ">'+
						'<div class="col-xs-4">'+
								'<div class="angularsl">'+
									'<select class="selectpicker">'+
										'<option value="1">全国</option>'+
										'<option value="2">北海道</option>'+
									'</select>'+
								'</div> <!-- end .angularsl -->'+
							'</div> <!-- end .col-xs-4 -->'+
							'<div class="col-xs-4">'+
								'<div class="angularsl">'+
									'<select class="form-control" multiple="multiple">'+
										'<option value="1">すべて</option>'+
										'<option value="2">1札幌市</option>'+
										'<option value="3" selected="selected">2札幌市</option>'+
										'<option value="4" selected="selected">3札幌市</option>'+
									'</select>'+
								'</div>'+
							'</div>'+
							'<div class="col-xs-4"><button type="button" class="btnic"><i class="fa fa-close"></i></button></div>'+
						'</div>';

			$('.append-bsearch').append(html);
		}
	
		//display cate/subcate
		var loadCatAll = function(dataLoad, tHeadVal, checkAllId) {
			html = '';
			let c = 0;
			
			$.each(dataLoad, function(index, val) {

				if( c%4 == 0 ) {
					html += '<tr>';
				}
				if( c == 0 ) {
					html += '<td class="dthead" rowspan="'+(Math.round(Object.keys(dataLoad).length/4)+1)+'">'+tHeadVal+'</td>';
				}
				html += '<td><div class="checkbox"><label>'+
				'<input type="checkbox" class="'+checkAllId+'" name="subcat[]" value="'+index+'" id="check_list-'+index+'">' + val
				'</label></div></td>';
				if( c%4 == 3 ) html += '</tr>';
				c += 1;
			});
			if( c/4 != 0) {
				for(let i = (4-(c%4)); i > 0; i--) {
					html += '<td>&nbsp;</td>';
				}
				html += '</tr>';
			}
			html += '<tr>'+
				'<td colspan="5" class="dright-el dbg-gray">'+
					'<div class="checkbox">'+
						'<label>'+
							'<input type="checkbox" value="'+checkAllId+'" class="check_list_all">全選択'+
						'</label>'+
					'</div>'+
				'</td>'+
			'</tr>';

			return html;
			
		}
		$(document).on('click', '.check_list_all', function() {
			var status = $(this).is(':checked');
			thisVal = $(this).val();
			var catId = [];
			$('.'+thisVal).each(function(index, el) {
				$(el).prop('checked', status);
				if($(this).is(':checked')) {
					catId.push($(el).val());
				}
				
			});
			// if(status == 'true') removeCatEl(catId);
			// else 
			if(thisVal=='bigcat') {
				loadSubAjax(catId);
			}
			
		});
		$(document).on('click', '.bigcat', function() {
			var catId = [];
			thisId = $(this).attr('data-id');
			$('.bigcat').each(function(index, el) {
				if($(this).is(':checked')) {
					catId.push($(el).val());
				}
				
			});
			loadSubAjax(catId);
		});

		$(document).on('click', '.btnic', function() {
			$(this).closest('.row').remove();
		});

		loadSubAjax = function(catId) {
			$.ajax({
				url: 'agency/get_category.json',
				dataType: 'JSON',
				success: function(json) {
					loadSubCat(json, catId);
				}
			});
		}
		var loadSubCat = function(json, catId) {
			// console.log(catId);return;
			html = '<h4 class="pagerow-title" id="sub-cat"><span>カテゴリー詳細</span></h4>';
			for(i = 0; i < catId.length; i++) {
				console.log(json.category[catId[i]]);
				// status = $('.bigcat[data-id="'+catId[i]+'"').is(':checked');
				// if(status == 'false') {
				// 	removeCatEl(catId);
				// }
				html += '<table id="subcat-table-'+catId[i]+'" class="table table-bordered dtable table-condensed dcat-table">';
				html += '<tbody>';
				html += loadCatAll(json.sub_category[catId[i]], json.category[catId[i]], 'scatlist-'+catId[i]);
				html += '</tbody>';
				html += '</table>';
			}
			
			$('#subcategory-list').html(html);
		}


		var removeCatEl = function(catId) {//console.log('#subcat-table-'+catId);
			//$('#subcat-table-'+catId).remove();
			$('#subcategory-list').empty();
			//$('#dat111').html('12');
		}

		$("#option1").click(function(){
			var dm = window.location.hostname;
			console.log(dm);
			window.location="agency/Cpart.php";
		})
		$("#option2").click(function(){
			window.location="agency/Cadd.php";
		})

	</script>
  </body>
</html