@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/user/agency/css/b_subsidylist.css">
@endsection
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
			<div class="col-sm-12">
				<div class="search-value-change">
					<span class="page-per-page">{{count($results)}}件/ {{$results->total()}}件</span>
					<div class="float-right">
						<form action="" method="POST" class="form-inline">
							<div class="form-group">
								<label for="">並び替え: </label>
								{!!Form::select('order-by', ['0'=>'新着順', '1'=>'取得金額が高い順', '2'=>'取得金額が低い順'], request()->order, ['class' => 'form-control order-by']) !!}
							</div>
							<div class="form-group">
								<label for="">表示件数: </label>
								{!!Form::select('per-page', config('combobox.per_page'), request()->per_page, ['class' => 'form-control per-page']) !!}
							</div>
						</form>
					</div> <!-- end float-right -->
				</div> <!-- end .search-value-change -->
			</div> <!-- end .col-sm-12 -->
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-title">募集案件</h3>
			</div>
			
		</div>
        
		<div class="row subsidy-list mgt-20">
			<div class="col-sm-12">
				<div class="subsidy-list-item mgt-30 mgbt-30">
				    <div class="col-sm-2 mgbt-30">
				        <a href="{{route('agency.cpart')}}" style="width:180px;" class="btn-primary btn btn-style-shadow-blue" >登録する</a>
				    </div>
				    <h4 class="col-sm-10">対応可能施策を登録すると、検索精度が上がります。また、直接事業者に提案を行えます。</h4>
				</div>
				@foreach($results as $val)
				{{ Form::open(['url' => route('agency.getbask'), 'method' => 'POST', 'id'=>'formID', 'enctype'=>'multipart/form-data']) }}
				<div class="subsidy-list-item">
					<div class="row">
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-2 mgt-20">
									<img src="{{ url($val->policy->image_id) }}" alt="">
									<input type="hidden" name="policy_id" value="{{$val->policy->id}}">
									<input type="hidden" name="searchtype" value="1">
									@if(is_array(request()->userids))
									@foreach(request()->userids as $userid)
										<input type="hidden" name="usercheck[]" value="{{$userid}}">
									@endforeach
									@else
										<input type="hidden" name="usercheck[]" value="{{request()->userids}}">
									@endif

								</div>
								<div class="col-sm-10">
									<div class="index-boxcol2-sub">
											<div class="boxlinkout">
												<p>
													<span class="sidy-tbig">{{str_limit($val->policy->name,46)}}</span><br>
													<strong>発行機関:</strong><span>{{str_limit($val->policy->register_insti_detail,20)}}</span>/
													<strong>対象地域:</strong><span>{{str_limit($val->policy->subscript_duration , 20)}}</span><br>
												</p>
												<span>{{str_limit($val->policy->target, 160)}}</span>
											</div> <!-- end .create-link-box -->
											
											<div class="middle-boxcol2">
												{!! Button::getFavourButtons($val->policy->id) !!}
											</div> <!-- end .middle-boxcol2 -->
									</div> <!-- end item index-boxcol2 -->
								</div>	<!-- end col-sm-10 -->
							</div> <!-- end .row -->
						</div>	<!-- end col-sm-10 -->
						<div class="col-sm-3 text-center">
							@if($val)
							<div class="box-yelow3 mgt-20 mgbt-20">
								<p>書類代行　<strong>{{$val->document_business_price}}円</strong></p>
								<p>成功報酬 <strong>{{$val->request_business_price}}円</strong></p>
								<p>着手金　　　<strong>{{$val->deposit_money}}円</strong></p>
								<p>その他　　　<strong>{{$val->other_money}}円</strong></p>
								<button class="btn btn-success btn-style-shadow-green" type="submit" style="width:200px;">提案する</button>
							</div>
                            @endif
						</div>
					</div> <!-- end .row -->
				</div> <!-- end .sidylist-item -->
				{{ Form::close() }}
				@endforeach
				<div class="clearfix"></div>
				<div class="text-center">
					{{ $results->appends(request()->query())->links() }}
				</div>
			</div> <!-- end .div.col-sm-12 -->

		</div> <!-- end .row -->
		
		<div class="col-sm-12 text-center mgt-30 mgbt-50"> 
	        <button type="button" class="btn btn-style-shadow-grey">戻る</button>
	    </div>
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
<div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
	    <div class="modal-content" style="height: 491.4px;">
	        <div class="modal-header text-center">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	            </button>
	            <h5 class="modal-title">マニュアル</h5>
	        </div>
	        <div class="modal-body">
	            <iframe width="100%" height="100%" src="{{URL::to('/manuals/registration_policy3/operationlecture.html')}}" frameborder="0"></iframe>
	        </div>
	    </div>
	</div>
</div>
@endsection
@section('script')
	<script>
		$(document).ready(function(){
			$('.checkboxcpart').each(function(){
				if($(this).find('input').is(':checked')) {
					$(this).find('label').removeClass('btn-success');
					$(this).find('label').removeClass('btn-style-shadow-green');
					$(this).find('label').addClass('btn-default');
					$(this).find('label').addClass('btn-style-shadow-grey1');
					$(this).find('label').text('選択中');
				}else{
					$(this).find('label').removeClass('btn-default');
					$(this).find('label').removeClass('btn-style-shadow-grey1');
					$(this).find('label').addClass('btn-success');
					$(this).find('label').addClass('btn-style-shadow-green');
					$(this).find('label').text('選択する');
				}
			});
			$('.tabtable').find('input').attr('disabled', true);
			$('.tabtable').hide();
			$('#tab_1').show();
			$('#tab_1').find('input').attr('disabled', false);
		});
		$(document).on('change', '.checkboxcpart', function(){
			if($(this).find('input').is(':checked')) {
				$(this).find('label').removeClass('btn-success');
				$(this).find('label').removeClass('btn-style-shadow-green');
				$(this).find('label').addClass('btn-default');
				$(this).find('label').addClass('btn-style-shadow-grey1');
				$(this).find('label').text('選択中');
			}else{
				$(this).find('label').removeClass('btn-default');
				$(this).find('label').removeClass('btn-style-shadow-grey1');
				$(this).find('label').addClass('btn-success');
				$(this).find('label').addClass('btn-style-shadow-green');
				$(this).find('label').text('選択する');
			}
		});
		$('.submit-ask').click(function() {
			var id = $('#selecttab').val();
			// if(!$('#'+id+' input[name="document_business_flag"]').is(":checked") && !$('#'+id+' input[name="request_business_flag"]').is(':checked'))
			// {
			// 	alert("費用を正確に入力してください。");
			// 	return;
			// }
			if($('#'+id+' input[name="deposit_money"]').val()<0) {
                alert("すべての項目を正確に入力してください!");
                return false;
            }
			if($('#'+id+' input[name="document_business_flag"]').is(":checked"))
			{
				if($('#'+id+' input[name="document_business_price"]').val())
				{
					if($('#'+id+' input[name="document_business_price"]').val() < 0)
					{
						alert("すべての項目を正確に入力してください!");
						return;
					}
					if($('#'+id+' input[name="document_business_price"]').val() > 100 && document_business_type == 1)
					{
						alert("すべての項目を正確に入力してください!");
						return;
					}
				} else {
					alert("すべての項目を正確に入力してください!");
					return;
				}
			} else {
				request_business_price = 0;
			}
			if($('#'+id+' input[name="deposit_money"]').val()) {
				if($('#'+id+' input[name="deposit_money"]').val() == 0) {
					alert("すべての項目を正確に入力してください!");
					return;
				}
			}
		});
		$(document).on('click', '#removeitemcheck', function() {
			$('input.subsidyid:checked').each(function(){
				$(this).closest('.subsidy-list-item').remove();
			})
		});
		$(document).on('click', '#removeitemall', function() {
			$('.subsidy-list-item').remove();
		});
		$(document).on('change', '#selecttab', function(){
			var id = $(this).val();
			$('.tabtable').find('input').attr('disabled', true);
			$('.tabtable').hide();
			$('#'+id).show();
			$('#'+id).find('input').attr('disabled', false);
		});
		$(document).on('change', '.subsidyid', function(){
			$('.subsidy-list-item').removeClass('active');
			if($(this).is(':checked')) {
				$(this).closest('.subsidy-list-item').addClass('active');
			}else{
				$(this).closest('.subsidy-list-item').removeClass('active');
			}
			
		});
		$(document).on('click', '.hiddenitem', function(){
			$(this).closest('.subsidy-list-item').remove();
			
		});


		$('.dcheck-dis').change(function() {
			var input_parent = $(this).parents('td').next().find('input[type="text"],input[type="number"]');
			if($(this).is(':checked')) {
				input_parent.attr('readonly', false).trigger('change');
			} else {
				input_parent.attr('readonly', true).trigger('change');
			}
			if(input_parent.prop('type') == 'number') input_parent.val('0');
			else input_parent.val('');
			all_cal();
		});
		$(document).on('keyup', '.dother-cost', function(){
			var obj = $(this);
			var total = 0;
			for (var i = 1; i <= 5; i++) {
				total += parseInt(obj.closest('table').find('input[name="dother_cost_i'+i+'"]').val());
			}
			var percen = parseInt(obj.closest('table').find('input[name="request_business_price"]').val());
			obj.closest('table').find('.total-value').text(total);
			obj.closest('table').find('#other_money').val(total);
			obj.closest('table').find('.total_pc_page').text(percen);
			var business_price = parseInt(obj.closest('table').find('input[name="document_business_price"]').val());
			isNaN(business_price)? 0: business_price;
			var deposit_money = parseInt(obj.closest('table').find('input[name="deposit_money"]').val());
			obj.closest('table').find('.total_val_page').text(business_price+total+deposit_money);

		});
		$(document).on('change', '.dother-cost', function(){
			var obj = $(this);
			var total = 0;
			for (var i = 1; i <= 5; i++) {
				total += parseInt(obj.closest('table').find('input[name="dother_cost_i'+i+'"]').val());
			}
			var percen = parseInt(obj.closest('table').find('input[name="request_business_price"]').val());
			obj.closest('table').find('.total-value').text(total);
			obj.closest('table').find('#other_money').val(total);
			obj.closest('table').find('.total_pc_page').text(percen);
			var business_price = parseInt(obj.closest('table').find('input[name="document_business_price"]').val());
			if(isNaN(business_price)) business_price = 0;
			var deposit_money = parseInt(obj.closest('table').find('input[name="deposit_money"]').val());
			obj.closest('table').find('.total_val_page').text(business_price+total+deposit_money);
		});
		$(document).on('click', '.dother-cost', function(){
			var obj = $(this);
			var total = 0;
			for (var i = 1; i <= 5; i++) {
				total += parseInt(obj.closest('table').find('input[name="dother_cost_i'+i+'"]').val());
			}
			var percen = parseInt(obj.closest('table').find('input[name="request_business_price"]').val());
			obj.closest('table').find('.total-value').text(total);
			obj.closest('table').find('#other_money').val(total);
			obj.closest('table').find('.total_pc_page').text(percen);
			var business_price = parseInt(obj.closest('table').find('input[name="document_business_price"]').val());
			isNaN(business_price)? 0: business_price;
			var deposit_money = parseInt(obj.closest('table').find('input[name="deposit_money"]').val());
			obj.closest('table').find('.total_val_page').text(business_price+total+deposit_money);
		});
		$(document).on('click', '#submit_edit', function(){
			if(!$('input.subsidyid:checked').length) {
                alert("一つ以上の施策を選択してください。");
            }else{
            	$('#form_edit').show();
            }
		});

		$(document).on('click', '#delete_matching', function(){
			if(!$('input.subsidyid:checked').length) {
                alert("一つ以上の施策を選択してください。");
            }else{
            	var url = "{{route('agency.deletematching')}}";
            	var id = $('input.subsidyid:checked').val();
            	url += '/'+id;
            	$.confirm({
				    title: '対応可能施策一覧からも削除されますがよろしいですか？',
				    content: "",
				    typeAnimated: true,
				    boxWidth: '700px',
				    useBootstrap: false,
				    buttons: {
				        tryAgain: {
				            text: 'いいえ',
				            action: function(){
				            	window.location.href = url;
				            }
				        },
				        close: {
				            text: 'はい',
				            action: function(){
				            	this.close();
				            }
				        },
			    	}
				});
            }
		});
		
	</script>
@endsection