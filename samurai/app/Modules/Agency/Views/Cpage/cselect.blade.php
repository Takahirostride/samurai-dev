@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/user/agency/css/b_subsidylist.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '施策登録'])
			</div>
		</div>
		<div class="row">
	        <div class="col-sm-12">
	            <p class="text-step "><b><span>STEP1</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;対応可能施策情報の選択</b>
	            </p>
	        </div>
	    </div>
	    {{ Form::open(['url' => route('agency.csetbalance'), 'method' => 'GET', 'enctype'=>'multipart/form-data']) }}
		<div class="row">
			<div class="col-xs-8 subsidydetail mgt-30">
				<p class="stitle1">{!! $policy_data->name !!}</p>
				<p class="stitle2">{!! $policy_data->name !!}</p>
				<p class="sdesc">登録機関:{!! $policy_data->register_insti_detail !!}<span>更新日:{!! $policy_data->update_date !!}</span></p>
				<div class="middle-boxcol2">
					{!! Button::getFavourButtons($policy_data->id) !!}
				</div> <!-- end .middle-boxcol2 -->
				<div class="sdetail">
					<p class="sdetail-title">目的</p>
					{!! $policy_data->target !!}
					<p class="sdetail-title">対象者の詳細</p>
					{!! $policy_data->info !!}
					<p class="sdetail-title">支援内容</p>
					{!! $policy_data->support_content !!}
					<p class="sdetail-title">支援規模</p>
					<table class="table table-bordered support-scale text-center">
						<tbody>
							<tr>
								<td width="33%">下限</td>
								<td width="33%">上限</td>
								<td width="33%">助成率</td>
							</tr>
							<tr>
								<td class="text-center std"><span class="fake-input">{!! $policy_data->support_scale_lower_limit !!}</span></td>
								<td class="text-center std"><span class="fake-input">{!! $policy_data->support_scale_upper_limit !!}</span></td>
								<td class="text-center std"><span class="fake-input">{!! $policy_data->support_scale_subsidy_duration !!}</span></td>
							</tr>
						</tbody>
					</table>
					{!! $policy_data->support_scale !!}
					@if($policy_data->subscript_duration)
					<p class="sdetail-title">募集期間</p>
					{!! $policy_data->subscript_duration !!}
					@endif
					@if($policy_data->object_duration)
					<p class="sdetail-title">対象期間</p>
					{!! $policy_data->object_duration !!}
					@endif
					<p class="sdetail-title">対象地域</p>
					{!! $policy_data->region !!}
					@if($policy_data->adopt_result)
					<p class="sdetail-title">採択結果</p>
					{!! $policy_data->adopt_result !!}
					@endif

					<p class="sdetail-title">掲載終了日</p>
					@if(!$policy_data->subscript_duration_option)
					{!! $policy_data->subscript_duration_detail !!}
					@endif
					@if(!$policy_data->subscript_duration_option)
					<p>随時</p>
					@endif
					@if(count(json_decode($policy_data->register_pdf, true)) || count(json_decode($policy_data->register_pdf1, true)))
					<p class="sdetail-title">pdfデータ</p>
					@endif
					@if(count(json_decode($policy_data->register_pdf, true)))
					<a href="{{url($policy_data->register_pdf[1])}}" class="aline">{{url($policy_data->register_pdf[0])}}</a>
					@endif

					<p>
					@if(count(json_decode($policy_data->register_pdf1, true)))
						@foreach(json_decode($policy_data->register_pdf1, true) as $key => $register_pdf1)
							<a href="{{$register_pdf1['url']}}" class="aline">{{$register_pdf1['name']}}</a>
						@endforeach
					@endif
					</p>
					<p class="sdetail-title">お問い合せ</p>
					{!! nl2br($policy_data->inquiry) !!}
				</div><!-- end .sdetail -->
			</div><!-- end left-detail -->
		</div> <!-- end .row -->
		<div class="clearfix"></div>
		<div class="row mgt-30 mgbt-50">
			<div class="col-sm-12">
				<p class="text-center">
					<div class="checkboxcpart pull-left mgr-10">
						<input type="checkbox" value="{{$policy_data->id}}" class="subsidyid" name="subsidyid[]" id="check_{{$policy_data->id}}">
						<label for="check_{{$policy_data->id}}" class="btn  btn-success  btn-style-shadow-green">選択する</label>
					</div>
                    <button id="submit_csetbalance" type="submit" class="btn btn-default btn-style-shadow-grey">戻る</button>
                </p>
			</div>
		</div>
		{{ Form::close() }}
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
		$(document).on('click', '#submit_csetbalance', function() {
			if(!$('input.subsidyid:checked').length) {
                alert("一つ以上の施策を選択してください。");
                return false;
            }
			// return false;
		});
	</script>
@endsection