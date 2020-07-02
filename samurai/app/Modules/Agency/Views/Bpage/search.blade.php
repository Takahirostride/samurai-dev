@extends('layouts.home')
@section('content')
@php
	$request = request();
@endphp
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '手動マッチング'])
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="navi-content">
					<ul class="nav">
						<li>
							<a href="{{route('agency.bsubsidylist')}}">自動検索</a>
						</li>
						<li class="active">
							<a href="javascript:void()">手動検索</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="row subsidy-list">
					<div class="col-sm-12">
					{{ Form::open(['url' => route('agency.bsearch'), 'method' => 'GET', 'enctype'=>'multipart/form-data']) }}
						<table class="table table-bordered form-table">
							<!-- <tr>
								<th>支援内容</th>
								<td>
									<div class="row">
										<div class="col-sm-4">
											<div class="checkbox"><label><input type="checkbox" name="contents[]" value="1" @if(@in_array(1, request()->contents)) checked="" @endif >補助金・助成金</label></div>
										</div>
										<div class="col-sm-4">
											<div class="checkbox"><label><input type="checkbox" name="contents[]" value="2" @if(@in_array(2, request()->contents)) checked="" @endif >金融・税制</label></div>
										</div>
										<div class="col-sm-4">
											<div class="checkbox"><label><input type="checkbox" name="contents[]" value="3" @if(@in_array(3, request()->contents)) checked="" @endif >その他</label></div>
										</div>
									</div>
								</td>
							</tr> -->
							<tr>
								<th>カテゴリー</th>
								<td>
									<div class="row">
										@if($categorys)
										@foreach($categorys as $index => $category)
											@if(@$category->id)
											<div class="col-sm-4">
												<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="{{$category->id}}" sub-id="sub_{{$category->id}}" {{ @in_array($category->id,request()->category)?'checked':'' }} >{{$category->category_name}}</label></div>
											</div>
											@endif
										@endforeach
										@endif
									</div>
									<div class="text-right mgbt-20">
										<button type="button" data-check="bigcat" class="check_all btn btn-default btn-lg mgr-20">全選択</button>
										<button type="button" data-check="bigcat" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>
									</div>
									@if($categorys)
									@foreach($categorys as $index => $category)
									@if(@$category->subcategory)
									<table id="sub_{{$category->id}}" class="table table-bordered dtable table-condensed dcat-table subcattable">
										<tbody>
											<tr>
												<th colspan="4">{{$category->category_name}}</th>
											</tr>
											<tr>
											@if(@$category->subcategory)
												@foreach($category->subcategory as $index => $categorysub)
												<td>
													@if(@$categorysub->id)
													<div class="checkbox"><label><input type="checkbox" class="subcat" name="categorysubs[]" value="{{$categorysub->id}}" id="check_list_bigcat-1" {{ @in_array($categorysub->id,request()->categorysubs)?'checked':'' }} >{{$categorysub->sub_name}}</label></div>
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

								</td>
							</tr>
							<tr>
								<th>対象地域</th>
								<td>
									@php
										$sl_region = $request->query('region',0);
										$sl_cities = $request->query('cities',[]);
									@endphp
									<select class="form-control max-w5 selectregion" name="region" data-cities="{{ implode(',',$sl_cities) }}">
										<option value="" disabled selected hidden>都道府県を選択してください</option>
										@if($regions) 
										@foreach($regions as $region)
											<option value="{{$region->id}}" {{ ($region->id==request()->region)?'selected':'' }} >{{$region->province_name}}</option>
										@endforeach
										@endif
									</select>

									<div class="row mgt-20" id="cities_checkbox">
										
									</div>
									<div class="pro-checkbox">
										<div class="checkbox"><label><input type="checkbox" class="" name="location[]" value="0"  {{ in_array(0,$request->query('location',[]))?'checked':'' }}>全国を対象にした施策を含む</label></div>
										<div class="checkbox"><label><input type="checkbox" class="" name="location[]" value="1"  {{ in_array(1,$request->query('location',[]))?'checked':'' }}>誘致関連施策を含む</label></div>
									</div>
								</td>
							</tr>
							<tr>
								<th>キーワード</th>
								<td>
									<input type="text" name="keyword" class="form-control" value="{{request()->keyword}}"> 
								</td>
							</tr>
							<tr>
								<th>対象者</th>
								<td>
									@php
										$sl_tags = $request->query('tags',[]);
										$tags=['中小企業','小規模事業者','その他']
									@endphp
									@foreach ($tags as $tag)
										<div class="col-sm-4">
											<div class="checkbox"><label><input type="checkbox" class="address_ministry" name="tags[]" value="{{ $tag }}"  {{ in_array($tag,$sl_tags)?'checked':'' }}>{{$tag}}</label></div>
										</div>									
									@endforeach
									<div class="text-right mgbt-20">
										<button type="button" data-check="address_ministry" class="check_all btn btn-default btn-lg mgr-20">全選択</button>
										<button type="button" data-check="address_ministry" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>
									</div>
								</td>
							</tr>
							<tr>
								<th>業種</th>
								<td>
									@if(@$trades)
									@foreach($trades as $index => $trade)
									<div class="col-sm-4">
										<div class="checkbox"><label><input type="checkbox" class="trades" name="trades[]" value="{{$trade->id}}" id="check_list_bigcat-1" {{ @in_array($trade->id,request()->trades)?'checked':'' }}>{{$trade->trade}}</label></div>
									</div>
									@endforeach
									@endif
									<div class="text-right mgbt-20">
										<button type="button" data-check="trades" class="check_all btn btn-default btn-lg mgr-20">全選択</button>
										<button type="button" data-check="trades" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>
									</div>
								</td>
							</tr>
						</table>
						<div class="text-center bsearch-btn-s">
							<button id="checksearch" name="searchtype" value="1" type="submit" class="btn btn-success btn-style-shadow-green">検索</button>
						</div>
					{{ Form::close() }}
					</div> <!-- end .div.col-sm-12 -->
				</div> <!-- end .row -->
			</div> <!-- end .mainpage -->
			@if($results && $results->total() > 0)
			<div class="col-sm-12">
				<table class="table table-bordered mgbt-0">
					<thead>
						<tr>
							<th>
								<span class="page-per-page">検索結果: {{$results->total()}}件</span>
								<div class="float-right">
									<form action="" method="POST" class="form-inline">
										<div class="form-group">
											<label for="">並び替え: </label>
											{!!Form::select('order-by', config('combobox.order_by'), request()->order, ['class' => 'form-control order-by']) !!}
										</div>
										<div class="form-group">
											<label for="">表示件数: </label>
											{!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page']) !!}
										</div>
									</form>
								</div> <!-- end float-right -->
							</th>
						</tr>
					</thead>
				</table>
				@foreach($results as $key => $val)
				@if($payroll==0 && !strpos(@$val->policy->acquire_budget, '0'))
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>
								<div class="row" style="margin-left: 15px;background-image: url({{url('/assets/photo/mosaic.png')}});height:200px;background-size: contain;background-repeat: no-repeat;">
			                        <div class="row" style="margin-top: 5px;margin-bottom: 25px;">
			                            <div class="col-sm-12">
			                            	@if($val->acquire_budget_display==1)
			                                <div class="btn-cost">
			                                    <label class="label-cost">{{$val->acquire_budget_display}}</label>
			                                </div>
			                                @endif
			                            </div>
			                        </div>
			                    </div>
							</td>
						</tr>
					</tbody>
				</table>
                @else
                <div class="create-link-box-x">
					<table class="table table-bordered subsidylist">
						<tbody>
							<tr>
								<td rowspan="2">
									@if($val->image_id)
										<img src="{{ asset($val->image_id) }}" alt="{{str_limit($val->name,34)}}">
									@endif	
								</td>
								<td>
									<p><a href="{{route('agency.bselect', ['policy_id' => $val->id])}}"><span class="sidy-tbig">{{str_limit($val->name,34)}}</span></a></p>
									<p class="text-right text-primary">
										<strong>発行機関:</strong><span>{{$val->minitry_text()}}</span>/
										<strong>対象地域:</strong><span>{{$val->region_text()}}</span>
										<strong>募集時期:</strong><span>{{str_limit($val->subscript_duration , 124)}}</span>
									</p>
								</td>
								<td rowspan="3">
									@if($val->paid_user)
									<div class="row">
										<div class="col-xs-9">
											<div class="subsidylist-item-av div-style-grey">
												<img src="{{url($val->paid_user[0]->image)}}" alt="">
												<div class="itemav-info">
													<p>事業者名{{$val->paid_user[0]->displayname}}</p>
													<div class="clearfix">
														<span class="pull-left">実績     ：</span>
														<div class="pull-left star-rating fbrtdiv-{{$key}}">
														    <select class="fbrtsl-{{$key}}" data-current-rating="{{$val->paid_user[0]->evaluate}}" name="rating" autocomplete="off">
														        <option value=""></option>
														        <option value="1">1</option>
														        <option value="2">2</option>
														        <option value="3">3</option>
														        <option value="4">4</option>
														        <option value="5">5</option>
														    </select>
														</div>
													</div>
													<p>実績：{{$val->paid_user[0]->result}}件</p>
												</div>
												@if($val->seller_exist_flag == 'success')
													<div class="div-style-grey">
			                                            <div class="imagecenter">
			                                                <img src="{$val->seller->image_url}}" style="max-width:200px;max-height:105px;">
			                                            </div>
			                                        </div>
			                                    @endif
			                                    <div class="clearfix"></div>
												<p>{{$val->paid_user[0]->self_intro}}</p>
											</div>
										</div>
										<div class="col-xs-3">
											<div class="mgl--20">
												<img class="user_av"  src="{{url('assets/photo/clienticon.png')}}" alt="">
												<p class="count_user">他{{count($val->matchingUser)}}人</p>
												@if(count($val->seller_policy))
												<img class="user_av"  src="{{url('assets/photo/clientgrey.png')}}" alt="">
												<p class="count_user">他{{count($val->seller_policy)}}社</p>
												@endif
											</div>
										</div>
									</div>
									@endif
								</td>
							</tr>
							<tr>
								<td>
									<ul class="tag-list">
									@if($val->tags)
										@foreach($val->tags as $key => $tag)
										<li><span>{{str_limit($tag->tag,10)}}</span></li>
										@endforeach
									@endif
									</ul>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div class="row">
										<div class="col-sm-9">
											<div class="dpleft-bottom">
												<div class="dp-sp-scale">
													<span class="rounder-sp"><span></span>支援規模</span>
													{!! str_limit($val->support_content, 80) !!}
												</div>
												<div class="dp-sp-scale">
													<span class="rounder-sp"><span></span>支援規模</span>
													{!! str_limit($val->support_scale, 80) !!}
												</div>
												<div class="dp-sp-scale">
													<span class="rounder-sp"><span></span>施策種別</span>
													<p class="dsp-price">{!! str_limit($val->acquire_budget_display, 80) !!}</p>
												</div>
											</div>
										</div>
										<div class="col-sm-3 text-right">
											<a  href="{{route('agency.bselect', ['policy_id' => $val->id])}}" class="btn btn-default btn-suggest">提案する</a>
											<p>{!! Button::getBookmarkButton($val) !!}</p>
											
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				@endif
				@endforeach
				<div class="text-center">
					{{ $results->appends(request()->query())->links() }}
				</div>
			</div>
			@endif
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
						$(el).prop('checked', false).trigger('change');
					});
					$('.subcattable').show();
				}else{
					$('.subcat').each(function(index, el) {
						$(el).prop('checked', false).trigger('change');
					});
					$('.subcattable').hide();
				}
			});
		});

		$(document).on('change', '.bigcat', function() {
			subid = '#'+$(this).attr('sub-id');
			if($(this).is(':checked')) {
				$(subid).show();
			}else{
				$(subid+' .subcat').each(function(index, el) {
					$(el).prop('checked', false).trigger('change');
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
                    str += '<div class="col-sm-4">\
								<div class="checkbox"><label><input type="checkbox" class="cities" name="cities[]" value="'+key+'">'+ar[key]+'</label></div>\
							</div>';
                }
                if(str!='') {
	                str += '<div class="text-right mgbt-20">\
						<button type="button" data-check="cities" class="check_all btn btn-default btn-lg mgr-20">全選択</button>\
						<button type="button" data-check="cities" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>\
					</div>';
				}
                $('#cities_checkbox').html(str);
            });
		});
		$(document).on('click', '#checksearch', function() {
			// var ar = $('input.bigcat:checked').map(function(c, el) {
			//     return $(el).val();
			// }).get();
			// for(key in ar){
			// 	if(!$('#sub_'+ar[key]+' input.subcat:checked').length) {
   //                  // alert("すべての項目を正確に入力してください");
   //                  dialog('','すべての項目を正確に入力してください', '確認');
   //                  return false;
   //              }
			// }
			// return false;
		});
		var count_fb = {{count($results)}};
		$(document).ready(function() {
			for( i = 0; i < count_fb; i++)
			{
				starRatingInit('.fbrtdiv-'+i, '.fbrtsl-'+i);
			}

			$('.bigcat').each(function() {
				subid = '#'+$(this).attr('sub-id');
				if($(this).is(':checked')) {
					$(subid).show();
				}else{
					$(subid+' .subcat').each(function(index, el) {
						$(el).prop('checked', false).trigger('change');
					});
					$(subid).hide();
				}
			});

			var url = '{{URL::to("/agency/ajaxGetCity")}}'+'/'+$('.selectregion').val();
			$.get(url, function(data, status){
                var ar = JSON.parse(data);
                var str = '';
                for(key in ar){
                    str += '<div class="col-sm-4">\
								<div class="checkbox"><label><input type="checkbox" name="cities[]" value="'+key+'">'+ar[key]+'</label></div>\
							</div>';
                }
                $('#cities_checkbox').html(str);
            });
            //initial region
			var $selectregion = $('.selectregion');
			if($selectregion.length > 0){
				var $selectregion_opt = $selectregion.find('option:selected');
				var selectregion_val = $selectregion_opt.val();
				if(selectregion_val !== null && selectregion_val!=''){
					var selectregion_url = '{{URL::to("/agency/ajaxGetCity")}}'+'/'+selectregion_val;
					var selectregion_def = $selectregion.data('cities').split(',');
					$.get(selectregion_url, function(data, status){					
		                var ar = JSON.parse(data);
		                var str = '';
		                var str_chk;
		                for(key in ar){
		                	str_chk = selectregion_def.indexOf(key) >= 0 ? 'checked':'';
		                    str += '<div class="col-sm-4">\
										<div class="checkbox"><label><input type="checkbox" name="cities[]" value="'+key+'" '+str_chk+'>'+ar[key]+'</label></div>\
									</div>';
		                }
		                $('#cities_checkbox').html(str);
		            });				
				}
			}
		});
	</script>
@endsection