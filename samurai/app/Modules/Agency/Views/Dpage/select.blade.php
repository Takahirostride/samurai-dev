@extends('layouts.home')
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '事業者検索'])
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">事業者検索</h1>
				<p class="page-description">この施策を必要としている事業者の検索が可能です。是非申請代行のオファーを出しましょう！</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<h3 class="mpage-title">リスト一覧</h3>
				<p><a href="{{route('agency.dfollowlist')}}" class="btn btn-default sidebar-btn btn-grad">
						<strong>フォロー</strong>
					</a></p>
				
			</div> <!-- end .sidebar-left -->
			<div class="col-sm-10 mainpage">
				<div class="row subsidy-list">
					<div class="col-sm-12">
					{{ Form::open(['url' => route('agency.dsearch'), 'method' => 'GET', 'enctype'=>'multipart/form-data']) }}
						{{Form::hidden('searchtype', 1)}}
						<h4 class="pagerow-title">
							<span>カテゴリー</span>
						</h4>
						<table class="table table-bordered dtable table-condensed dcat-table">
							<tbody id="category-list">
								<tr>
									<td class="dthead" rowspan="{{count($categorys)/4+2}}">&nbsp;</td>
								@if($categorys)
									@foreach($categorys as $index => $category)
									<td>
										@if(@$category->id)
										<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="{{$category->id}}" sub-id="sub_{{$category->id}}">{{$category->category_name}}</label></div>
										@endif
									</td>
									@php $num = $index+1 @endphp
									@if($num % 4 == 0) </tr><tr> @endif	
									@endforeach
								@endif
								<tr>
									<td colspan="4" class="dright-el dbg-gray"><div class="checkbox"><label><input type="checkbox" value="bigcat" class="check_list_all">全選択</label></div></td>
								</tr>
							</tbody>
						</table> <!-- end table category -->
						<div id="subcategory-list">
							<h4 class="pagerow-title">
								<span>カテゴリー詳細</span>
							</h4>
							@if($categorys)
							@foreach($categorys as $index => $category)
							@if(@$category->subcategory)
							<table id="sub_{{$category->id}}" class="table table-bordered dtable table-condensed dcat-table subcattable">
								<tbody>
									<tr>
										<td class="dthead" rowspan="{{count($category->subcategory)/4+2}}">{{$category->category_name}}</td>
									@if(@$category->subcategory)
										@foreach($category->subcategory as $index => $categorysub)
										<td>
											@if(@$categorysub->id)
											<div class="checkbox"><label><input type="checkbox" class="subcat" name="categorysub[]" value="{{$categorysub->id}}" id="check_list_bigcat-1">{{$categorysub->sub_name}}</label></div>
											@endif
										</td>
										@php $num = $index+1 @endphp
										@if($num % 4 == 0) </tr><tr> @endif	
										@endforeach
									@endif
									<tr>
										<td colspan="4" class="dright-el dbg-gray"><div class="checkbox"><label><input type="checkbox" value="sub_{{$category->id}}" class="check_list_all_sub">全選択</label></div></td>
									</tr>
								</tbody>
							</table> <!-- end table category -->
							@endif
							@endforeach
							@endif
						</div> <!-- end .subcat-disp -->
						<div class="clearfix"></div>
						<h4 class="pagerow-title">
							<span>対象地域</span>
						</h4>
						<div class="append-bsearch">
							<div class="row">
								<div class="col-xs-4">
									<div class="angularsl">
										<select class="selectpicker selectregion" name="region[]">
											<option value="全国">全国</option>
											@if($regions) 
											@foreach($regions as $region)
												<option value="{{$region->id}}">{{$region->province_name}}</option>
											@endforeach
											@endif
										</select>
									</div> <!-- end .angularsl -->
								</div> <!-- end .col-xs-4 -->
								<div class="col-xs-4">
									<div class="angularsl">
										<select class="form-control selectcity" name=cities[] multiple="multiple">
										</select>
									</div> <!-- end .angularsl -->
								</div> <!-- end .col-xs-4 -->
								<div class="col-xs-4">
									
								</div> <!-- end .col-xs-4 -->

							</div> <!-- end .row -->
						</div> <!-- end .append-bsearch -->
						<div class="clearfix"></div>
						<a href="javacript:void()" onclick="append_bsearch(); return false;" class="append-bsearch-link">複数選択をする</a>

						<div class="text-center bsearch-btn-s">
							<button id="checksearch" name="searchtype" value="1" type="submit" class="btn btn-success btn-style-shadow-green">検索する</button>
						</div>
					{{ Form::close() }}
					</div> <!-- end .div.col-sm-12 -->

				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
		</div> <!-- end .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@endsection
@section('script')
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
			var url = '{{URL::to("/agency/ajaxGetRegion")}}';
			console.log(url);
			$.get(url, function(data, status){
                var ar = JSON.parse(data);
                var str = '<option value="全国">全国</option>';

                for(key in ar){
                    str += '<option value="'+key+'">'+ar[key]+'</option>';
                }
                html = '<div class="row ">'+
					'<div class="col-xs-4">'+
							'<div class="angularsl">'+
								'<select class="selectpicker selectregion" name="region[]">'+str+
								'</select>'+
							'</div> <!-- end .angularsl -->'+
						'</div> <!-- end .col-xs-4 -->'+
						'<div class="col-xs-4">'+
							'<div class="angularsl">'+
								'<select class="form-control selectcity" name=cities[] multiple="multiple">'+
								'</select>'+
							'</div>'+
						'</div>'+
						'<div class="col-xs-4"><button type="button" class="btnic"><i class="fa fa-close"></i></button></div>'+
					'</div>';
				$('.append-bsearch').append(html);
				setupselect();
	        });

		}
		$(document).on('click', '.btnic', function() {
			$(this).closest('.row').remove();
		});
		
		$(document).on('click', '.check_list_all', function() {
			var status = $(this).is(':checked');
			thisVal = $(this).val();
			var catId = [];
			$('.'+thisVal).each(function(index, el) {
				$(el).prop('checked', status);
				if($(this).is(':checked')) {
					$('.subcat').each(function(index, el) {
						$(el).prop('checked', false);
					});
					$('.subcattable').show();
				}else{
					$('.subcat').each(function(index, el) {
						$(el).prop('checked', false);
					});
					$('.subcattable').hide();
				}
			});
		});

		$(document).on('click', '.bigcat', function() {
			subid = '#'+$(this).attr('sub-id');
			if($(this).is(':checked')) {
				$(subid).show();
			}else{
				$(subid+' .subcat').each(function(index, el) {
					$(el).prop('checked', false);
				});
				$(subid).hide();
			}
		});

		$(document).on('click', '.check_list_all_sub', function() {
			var status = $(this).is(':checked');
			thisVal = $(this).val();
			$('#'+thisVal+' .subcat').each(function(index, el) {
				$(el).prop('checked', status);
			});
		});
		$(document).on('change', '.selectregion', function() {
			var obj = $(this);
			var url = '{{URL::to("/agency/ajaxGetCity")}}'+'/'+obj.val();
			$.get(url, function(data, status){
                var ar = JSON.parse(data);
                var str = '';
                for(key in ar){
                    str += '<option value="'+key+'">'+ar[key]+'</option>';
                }
                obj.closest('.row').find('.selectcity').html(str);
            });
		});
		$(document).on('click', '#checksearch', function() {
			var ar = $('input.bigcat:checked').map(function(c, el) {
			    return $(el).val();
			}).get();
			for(key in ar){
				if(!$('#sub_'+ar[key]+' input.subcat:checked').length) {
                    // alert("すべての項目を正確に入力してください");
                    dialog('','すべての項目を正確に入力してください', '確認');
                    return false;
                }
			}
			// return false;
		});
		$("#option1").click(function(){
			window.location="{{route('agency.cpart')}}";
		})
		$("#option2").click(function(){
			window.location="{{route('agency.cadd')}}";
		})

	</script>
@endsection