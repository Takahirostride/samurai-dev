@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/agency/css/b_select.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			@includeIf('partials.breadcrumb', ['title' => '手動マッチング'])
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">助成金・補助金自動マッチング</h1>
				<p class="page-description">プロフィールの設定にに対して、マッチングしている助成金・補助金が表示されています。対応可能と思われる、助成金・補助金の設定が行え、企業に直接営業も可能です。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<ul class="dtabprofile tab-profile nav nav-tabs">
					<li class="tab-style-grey"><a href="{{route('agency.bselect', ['policy_id' => $policy_id])}}"> 施策詳細</a></li>
					<li class="tab-style-grey active"><a href=""> 依頼詳細</a></li>
				</ul>
			</div> <!-- end .col-sm-12 -->
			<div class="clearfix"></div>
			<div class="col-xs-10 left-detail">
				<div class="row">
					<div class="col-sm-12">
						<div class="profile-av">
							<div class="row">
								<div class="col-sm-4">
									{{ HTML::image($user->image, '',['class'=>'profile-user-avatar']) }}
								</div>
								<div class="col-sm-8">
									<h4 class="main-user-name">{{$user->displayname}}</h4>
									<p class="main-user-id">ユーザーID：{{$user->id}}</p>
									<p class="main-user-total-job">実績：　{{$user->result}}件</p>
									<div class="star-rating">
										{!! Button::getRating($user->evaluate) !!}
								  </div>
								</div>
							</div>
						</div> <!-- end .profile-av -->
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="tab-profile nav nav-tabs">
							<li class="tab-style-grey"><a href="{{route('agency.RequestDetails', ['policy_id' => $policy_id, 'user_id' => $user->id])}}">プロフィール</a></li>
							<li class="tab-style-grey active"><a href="{{route('agency.EvaluationAchievements',['policy_id' => $policy_id, 'user_id' => $user->id])}}">評価・実績 </a></li>
							<li class="tab-style-grey"><a href="{{route('agency.Availablebusiness',['policy_id' => $policy_id, 'user_id' => $user->id])}}">興味ある内容</a></li>
							<li class="tab-style-grey"><a href="{{route('agency.ApplicableMeasures',['policy_id' => $policy_id, 'user_id' => $user->id])}}">対応可能施策</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4 class="pagerow-title">
							<span>カテゴリー</span>
						</h4>
						@if($user->cat)
						<table class="table table-bordered">
				            <tbody>
				            	<tr>
				            	@foreach($user->cat as $key => $cat)
					                <td style="width: 25%;">{{$cat->category_name}}</td>
					                @if(($key+1)%4==0)
					                	</tr><tr>
					                @endif
					            @endforeach
					            @for ($i = 0; $i < 4-(count($user->cat)%4); $i++)
					            	<td style="width: 25%;"></td>
					            @endfor
					            </tr>
				            </tbody>
				        </table>
				        @endif
				        @if($user->cat)
				        @foreach($user->cat as $key => $cat)
				        <table class="table table-bordered mgt-30">
				            <thead class="div-style-blue2">
					            <tr class="text-center">
					                <th colspan="2">{{$cat->category_name}}</th>
					                <th>現在</th>
					                <th>将来</th>
					            </tr>
				            </thead>
				            <tbody>
				            	@if($cat->subcategory)
				            	@foreach($cat->subcategory as $keys => $subcat)
					            <tr>
					                <td style="width: 5%">Q</td>
					                <td style="width: 60%">{{$subcat->detail_question}}<br></td>
					                <td class="text-center">
					                	@if(existquestioncheck($client_data, $subcat->detail_question, 2))
					                    <span class="glyphicon glyphicon-ok"></span>
					                    @endif
					                </td>
					                <td class="text-center">
					                   	@if(existquestioncheck($client_data, $subcat->detail_question, 3))
					                    <span class="glyphicon glyphicon-ok"></span>
					                    @endif
					                </td>
					            </tr>
					             @endforeach
					             @endif
				            </tbody>
				        </table>
				        @endforeach
				        @endif
					</div>
					<div class="col-sm-12">
						<h4 class="pagerow-title">
							<span>希望内容</span>
						</h4>
						@if($user->cat)
						<table class="table table-bordered" style="margin-top:20px;margin-bottom: 50px">
				            <tbody>
				            	<tr>
				            	@foreach($tags as $key => $tag)
					                <td style="width: 25%;">{{$tag->tag}}</td>
					                @if(($key+1)%4==0)
					                	</tr><tr>
					                @endif
					            @endforeach
					            @for ($i = 0; $i < 4-(count($tags)%4); $i++)
					            	<td style="width: 25%;"></td>
					            @endfor
					            </tr>
					            
				            </tbody>
				        </table>
				        @endif
					</div>
				</div>
			</div>
			{{ Form::open(['url' => route('agency.getbask'), 'method' => 'GET', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
			{{Form::hidden('searchtype', 1)}}
			<div class="col-xs-2">
				@include('Agency::Bpage.profile_sidebar',['profile_completed'=>$profile_completed, 'user'=>$user])
			</div><!-- end .col-xs-4 -->
			{{ Form::close() }}
		</div>
	</div>
</div>
@endsection
@section('script')
	<script src="/assets/agency/js/b_select.js"></script>
	<script type="text/javascript">
		var count_fb = {{count($results)}};
		$(document).ready(function() {
			for( i = 0; i < count_fb; i++)
			{
				starRatingInit('.fbrtdiv-'+i, '.fbrtsl-'+i);
			}
		});

		$(document).on('click' , '.submitbask' , function(){
			var policy_id = $(this).attr('data-pid');
			var user_id = $(this).attr('data-uid');
			$('#modal-Bask').find('input[name="policy_id[]"]').val(policy_id);
			$('#modal-Bask').find('input[name="usercheck[]"]').val(user_id);
			$('#modal-Bask').modal('show');
		});
		$(document).on('click' , '#BaskAjaxSubmit' , function(){
			if(!$('input[name="deli_date"]').val() || !$('input[name="deposit_money"]').val()) {
				alert('一つ以上の事業者を選択してください。');
				return false;
			}else{
				var data = new FormData($('form#formID')[0]);
				$.ajax({
				    url: '{{route('agency.bask.messbutton')}}',
				    data: data,
				    cache: false,
				    contentType: false,
				    processData: false,
				    method: 'POST',
				    type: 'json', // For jQuery < 1.9
				    success: function(data){
				    	var rs = JSON.parse(data);
				    	console.log(data);
				    	var base_url = window.location.origin;
				    	var url = base_url+'/agency/mypage/recruitment/requested/'+rs['hire_id'];
				    	// if(data == 'success') {
						    var str = '<div class="basksuccess text-center">\
								<h2>見積もり金額の提案を行いました。</h2>\
								<p>\
									仕事管理から事業者とSAMURAI内チャットでコンタクトを取ることができます。<br>\
									SAMURAIでは事業者との直接のやりとりを禁止しております。予めご了承ください\
								</p>\
								<p>\
									着手金がある場合の支払いが完了するまで、事業者は仕事管理の内容を見ることができません。\
								</p>\
								<p >\
									<a href="'+url+'" class="btn btn-success">仕事管理を見る</a>\
								</p>\
							</div><p class="text-center"><button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button></p>';
						// }else{
						// 	var str = '<div class="basksuccess text-center">\
						// 		<h2>ERROR</h2>\
						// 	</div><p class="text-center"><button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button></p>';
						// }

						$('#modal-baskform-content').html(str);		      
				    }
				});
				// return false;
				// $('#modal-Bask').modal('show');
			}
		});
		$(document).on('click' , '#BaskAjaxConfirm' , function(){
			if(!$('input[name="deli_date"]').val() || !$('input[name="deposit_money"]').val()) {
				alert('一つ以上の事業者を選択してください。');
				return false;
			}else{
				var deli_date = $('input[name="deli_date"]').val();
				var deposit_money = $('#deposit_money').val();
				var deposit_setting = $('#deposit_setting').val();
				if(deposit_money != '' ) deposit_money = parseInt(deposit_money);
				if(deposit_setting != '' ) deposit_setting = parseInt(deposit_setting);
				total1 = Math.ceil(deposit_money + ((deposit_money*deposit_setting)/100));
				total2 = Math.ceil(total1 + ((total1*sitefee)/100));
				var str = '<h3 class="text-center">納期と金額を修正して提案する</h3><div class="cf">\
					<div class="headercf">\
						<span class="ttcf">納期</span>\
						<span>\
							<span>:'+deli_date+'</span>\
						</span>\
					</div>\
					<div class="contentcf">\
						<p><span class="ttcf">報酬金額</span>\
						<span>\
							:<span class="boldtext">'+total1+'</span><span> 円+税</span>\
						</span></p>\
						<p><span class="ttcf">受け取り金額</span>\
						<span>\
							:<span class="boldtext">'+total2+'</span><span> 円+税</span>\
						</span></p>\
					</div>\
				</div>';
				var but = '<button type="button" class="btn btn-default" id="Baskformback">修正する</button>\
					<button type="button" id="BaskAjaxSubmit" class="btn btn-default baskbutton">この内容で提案する</button>';

				$('#daskconfirmdiv').html(str);
				$('#daskconfirmdiv').show();
				$('#formdask').hide();
				$('#allbutbask').html(but);
			}
		});
		$(document).on('click' , '#Baskformback' , function(){
			var but = '<button type="button" class="btn btn-default" id="Baskformback"  data-dismiss="modal">戻る</button>\
					<button type="button" id="BaskAjaxConfirm" class="btn btn-default baskbutton">内容を確認する</button>';

				$('#formdask').show();
				$('#daskconfirmdiv').hide();
				$('#allbutbask').html(but);
		});
		var sitefee = 5.5;
		var total1;
		var total2;
		var modalCalculator = function() {
			var deposit_money = $('#deposit_money').val();
			var deposit_setting = $('#deposit_setting').val();
			if(deposit_money != '' ) deposit_money = parseInt(deposit_money);
			if(deposit_setting != '' ) deposit_setting = parseInt(deposit_setting);
			total1 = Math.ceil(deposit_money + ((deposit_money*deposit_setting)/100));
			total2 = Math.ceil(total1 + ((total1*sitefee)/100));
			console.log(total1);
			$('#total1').text(total1);
			$('#total2').text(total2);
		}
		$('#deposit_money').change(function(event) {
			modalCalculator();
		});
		$('#deposit_setting').change(function(event) {
			modalCalculator();
		});
		$('#deposit_money').keyup(function(event) {
			modalCalculator();
		});
		$('#deposit_setting').keyup(function(event) {
			modalCalculator();
		});
		$(document).ready(function() {
			modalCalculator();
		});
		$('#datepickermodal').datepicker({
	    	language : 'ja-JP',
	        inline: true,
	        sideBySide: true,
	        todayHighlight: true,
	        format: "yyyy年mm月dd日"
	    });
	    $(document).on('click' , '.remove' , function(){
	    	$(this).closest('table').remove();
	    });
	</script>
@endsection