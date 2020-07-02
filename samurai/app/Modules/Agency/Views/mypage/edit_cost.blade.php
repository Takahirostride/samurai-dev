@extends('layouts.home')
@section('style')
	<style type="text/css">
		.desired-cost .col-sm-9:hover {
			background: #eee;
		}
		.no-hidden {
			display: none;
		}
	</style>
@endsection
@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">プロフィール</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">プロフィール</h1>
				<p class="page-description">プロフィールを詳細に記載していると、通常より申請が4倍通りやすくなる傾向があります。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
            		@php ($profile_image = $user->image)
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png')
            	@endif
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-8 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<div class="profile-av">
							<div class="row">
								<div class="col-sm-4">
									{{HTML::image($profile_image, '', ['class'=>'profile-user-avatar'])}}
								</div>
								<div class="col-sm-8">
									<h4 class="main-user-name">{{$user->displayname}} ({{$user->username}})</h4>
									<p class="main-user-id">ユーザーID：{{$user->id}}</p>
									<p class="main-user-total-job">実績：　{{$user->result}}件</p>
									<div class="star-rating stars-example-fontawesome-o">
										<select class="recom-rating-disabled" data-current-rating="{{$user->evaluate}}" name="rating" autocomplete="off">
											<option value=""></option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
								  </div>
								</div>
							</div>
						</div> <!-- end .profile-av -->
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="tab-profile nav nav-tabs nav-justified">
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile') }}"> <img src="{{URL::to('assets/common/images/manual.png')}}" alt="">プロフィール</a></li>
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile.availabletask') }}"><img src="{{URL::to('assets/common/images/manual.png')}}" alt=""> 興味ある内容 </a></li>
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile.availablesubsidy') }}">対応可能施策</a></li>
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile.rating') }}">評価・実績</a></li>
							<li class="tab-style-grey active"><a href="{{ URL::route('agency.profile.cost') }}"><img src="{{URL::to('assets/common/images/manual.png')}}" alt="">費用</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4 class="pagerow-title">
							<span>代行業務費用</span>
							<a href="{{URL::route('agency.profile.cost')}}" class="btn-primary btn btn-style-shadow-green btn-success right-title">保存する</a>
						</h4>
					</div>
				</div>
				<div class="row">
					<p class="col-sm-12 p-text1 font16">代行業務費用を設定しておくと、依頼者に費用を伝える際に、登録した費用を呼び出すことができます。<br>
                        代行業務費用が決まっている場合は、設定しておくと、入力の手間を省くことができます。</p>
				</div>
				@if(count($user->set_cost))
				<div class="row">
                    <div class="col-sm-12">
                        <h4 class="pagerow-title">
                            <span>設定登録費用一覧</span>
                        </h4>
                    </div>
                </div>
                <div class="row clientprofile-8">
                    <div class="col-sm-12">
                    
                    {{ Form::open(['method'=>'POST', 'class'=>'form']) }}
                    <div class="alert alert-success no-hidden" id="no-success">
                    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    	データを変更しました
                    </div>
                    <div class="alert alert-danger no-hidden" id="no-danger">
                    	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    	データを変更しませんでした
                    </div>
                    <table class="table table-hover table-bordered">
                        <tbody>
                            <tr>
                                <td class="div-style-blue2 text-primary">
                                    <select class="form-control" id="current-cost-select">
                                    	
                                    </select>
                                    <input type="hidden" id="current-select" value="">
                                    <b>&nbsp;</b>
                                    <table>
                                        <tbody><tr>
                                            <td>
                                                <button type="button" class="btn-danger btn btn-style-shadow-red btn-success" onclick="loadDeleteModal();">削除する</button>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                                <td>
                                    <div class="col-sm-12" align="right">
                                        <font>※クライアント支払金額から事務手数料5.5％が差し引かれます</font>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-3">
                                            <h5>業務内容</h5>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>
                                                        <input id="documentpriceflag" class="control-label" type="checkbox"> 書類代行費用 
                                                    </label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input id="documentprice" type="number" class="form-control " placeholder="金額" aria-invalid="false">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" >
                                                <div class="col-sm-4">
                                                    <label >
                                                        <input id="requestpriceflag" class="control-label" type="checkbox"  aria-invalid="false"> 成功報酬 
                                                    </label>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" id="requestprice" class="form-control " placeholder="金額" aria-invalid="false">
                                                        <span class="form-control-feedback">%</span>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-3">
                                            <h5>着手金</h5>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <h5>着手金</h5>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" id="deposit_money" class="form-control " placeholder="金額" aria-invalid="false">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="col-sm-3">
                                            <h5>その他費用</h5>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p class="cost-p">合計</p>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p>
                                                        <span id="show-total">0</span>円</p>
                                                        <input type="hidden" name="total" id="total">
                                                </div>
                                                <div class="col-sm-4">
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4"><h5 class="">内訳</h5>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" id="content_name_0" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" class="form-control sum" name="other-1" id="content_val_0" placeholder="金額" value="0">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" id="content_name_1" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" id="content_val_1" value="0" class="form-control sum" placeholder="金額" aria-invalid="false">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" id="content_name_2" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" id="content_val_2" class="form-control sum" placeholder="金額" aria-invalid="false" value="0">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" id="content_name_3" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" id="content_val_3" class="form-control sum" placeholder="金額" aria-invalid="false" value="0">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" id="content_name_4" class="form-control" placeholder="費用名" aria-invalid="false">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group has-feedback">
                                                        <input type="number" id="content_val_4" class="form-control sum" aria-invalid="false" value="0">
                                                        <span class="form-control-feedback">円</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-4">
                                                </div>
                                                <div class="col-sm-4">
                                                    <submit type="button" onclick="saveCost();" class="btn-primary btn btn-style-shadow-green btn-success">設定を保存</submit>
                                                </div>
                                                <div class="col-sm-4">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{Form::close()}}

                    </div>
                    
                </div>
                @endif
                <div id="myModal" class="modal fade  in">
                	<div class="modal-dialog">
                		<div class="modal-content"> 
                        	<p class="modal-header">テンプレートから削除しますか？ </p>                     
	                      	<div class="modal-body">
	                        	<div class="row">
	                            	<div class="col-sm-6 col-sm-offset-3">
	                                	<button type="button" class="btn btn-success btn-style-shadow-green" onclick="deleteCost();" data-dismiss="modal">はい</button>
	                                	<button type="button" class="btn btn-danger btn-style-shadow-red exit" data-dismiss="modal">いいえ</button>        
	                            	</div>
	                        	</div>
	                    	</div> <!-- end .modal-body -->
                    	</div> <!-- end .modal-content -->
                  	</div> <!-- end .modal-dialog -->
                </div> <!-- end modal -->
			</div> <!-- end .mainpage -->
			<div class="col-sm-2 sidebar-right">
				@include('Agency::includes.sidebar-right')
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script>
		var set_cost = '';
		var base_url = '{{URL::to('/')}}';
		$(document).ready(function() {
			loadSetCost(0);

		});
		var loadSetCost = function(current_select) {
			$.ajax({
				url: base_url + '/agency/mypage/profile/edit-cost-ajax',
				data: {act: 'getUserCost'},
				type: 'POST',
				success: function(json) {
					set_cost = json.set_cost;console.log(set_cost);
					loadFormData(current_select);
				}
			});
		}
		var loadFormData = function(current_select) {
			var html = '';
			$.each(set_cost, function(index, val) {
                selected = '';
                if(index == current_select) selected = ' selected="selected"';
				html += '<option value="'+index+'"'+selected+'>登録内容'+(index+1)+'</option>';
			});
			$('#current-cost-select').html(html);
			$('#current-select').val(current_select);
			fillFormData();
		}
		$(document).on('change', '#current-cost-select', function() {
			$('#current-select').val( $('#current-cost-select').val() );
			fillFormData();
		});
		var fillFormData = function() {
			var currentIndex = $('#current-select').val();
			var currentVal = set_cost[currentIndex];
			if(currentVal.document_price_flag)
			{
				if(!$('#documentpriceflag').is(':checked')) $('#documentpriceflag').trigger('click');
			} else {
				if($('#documentpriceflag').is(':checked')) $('#documentpriceflag').trigger('click');
			}
			$('#documentprice').val(currentVal.document_business_price);
			if(currentVal.request_price_flag)
			{
				if(!$('#requestpriceflag').is(':checked')) $('#requestpriceflag').trigger('click');
			} else {
				if($('#requestpriceflag').is(':checked')) $('#requestpriceflag').trigger('click');
			}
			$('#requestprice').val(currentVal.request_business_price);
			$('#deposit_money').val(currentVal.deposit_money);
			html = '';
			for(i = 0; i < currentVal.content_type.length; i++)
			{
				moneyname = currentVal.content_type[i].moneyname;
				if(moneyname == null) moneyname = '';
				moneyvalue =currentVal.content_type[i].moneyvalue
				$('#content_name_'+i).val( moneyname );
				$('#content_val_'+i).val( moneyvalue );
			}
			sumTotal();
			
		}
		var sumTotal = function() {
			total = 0;
			$('.has-feedback .sum').each(function(index, el) {
				total += parseInt($(el).val());
			});
			$('#show-total').text(total);
			$('#total').val(total);
		}
		$(document).on('change', '.has-feedback .sum', function() {
			sumTotal();
		});
		$(document).on('click', '#documentpriceflag', function() {
			if(!$('#documentpriceflag').is(':checked')) $('#documentprice').prop('disabled', true);
			else $('#documentprice').prop('disabled', false);
		});
		$(document).on('click', '#requestpriceflag', function() {
			if(!$('#requestpriceflag').is(':checked')) $('#requestprice').prop('disabled', true);
			else $('#requestprice').prop('disabled', false);
		});
		var loadDeleteModal = function() {
			$('#myModal').modal();
		}
		var deleteCost = function() {
			var currentIndex = $('#current-select').val();
			$.ajax({
				url: base_url + '/agency/mypage/profile/edit-cost-ajax',
				data: {act: 'deleteUserCost', del_id: currentIndex},
				type: 'POST',
				success: function(json) {
					set_cost = json.set_cost;
					loadFormData();
				}
			})
		}
		var saveCost = function() {
			var currentIndex = $('#current-select').val();
			var set_cost = [];
			set_cost['document_price_flag'] = ($('#documentpriceflag').is(':checked')?true:false);
			set_cost['document_business_price'] = $('#documentprice').val();
			set_cost['request_price_flag'] = ($('#requestpriceflag').is(':checked')?true:false);
			set_cost['request_business_price'] = $('#requestprice').val();
			set_cost['deposit_money'] = $('#deposit_money').val();
			set_cost['content_type'] = [];
			for(i = 0; i < 5; i++)
			{
				set_cost['content_type'].push({moneyname: $('#content_name_'+i).val(), moneyvalue: $('#content_val_'+i).val()});
			}
			$.ajax({
				url: base_url + '/agency/mypage/profile/edit-cost-ajax',
				data: {
					act: 'updateCost', 
					document_price_flag: set_cost['document_price_flag'], 
					document_business_price: set_cost['document_business_price'], 
					request_price_flag: set_cost['request_price_flag'], 
					request_business_price: set_cost['request_business_price'], 
					deposit_money: set_cost['deposit_money'], 
					content_type: set_cost['content_type'], 
					current_cost: currentIndex
				},
				type: 'POST',
				success: function(json) {
					$('#no-success').removeClass('no-hidden');
					setTimeout(function(){ $('#no-success').addClass('no-hidden'); }, 5000);
                    loadSetCost($('#current-select').val());
				}
			})
			
		}

	</script>

@endsection