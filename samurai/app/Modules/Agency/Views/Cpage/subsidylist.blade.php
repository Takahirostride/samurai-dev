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
	            <a href="#modal-registration-policy3" data-toggle="modal" data-target="#myModal"><img src="/assets/common/images/manual.png" style="cursor:pointer;" height="20px"></a>
	            </p>
	        </div>
	    </div>
	    {{ Form::open(['url' => route('agency.csetbalance'), 'method' => 'GET', 'enctype'=>'multipart/form-data']) }}
		<div class="row subsidy-list">
			<div class="col-sm-12">
				@foreach($results as $val)
				<div class="subsidy-list-item">
					<div class="row">
						<div class="col-sm-10">
							<div class="index-boxcol2-sub">
									<div class="create-link-box">
										<a href="{{route('agency.cselect', ['policy_id' => $val->id])}}"></a>
										<div class="left-boxcol2">
											<img src="{{ url($val->image_id) }}" alt="">
										</div>

										<div class="right-boxcol2">
											<p>
												<a href="#" class="boxcol2-a-2">
													<span class="sidy-tbig">{{str_limit($val->name,66)}}</span><br>
													<strong>発行機関:</strong><span>{{str_limit($val->register_insti_detail,24)}}</span>/
													<strong>対象地域:</strong><span>{{str_limit($val->region , 48)}}</span><br>
													<strong>募集時期:</strong><span>{{str_limit($val->subscript_duration , 172)}}</span>
												</a>
												<span>{{$val->target}}</span>
											</p>
										</div>
									</div> <!-- end .create-link-box -->
									
									<div class="middle-boxcol2">
										{!! Button::getFavourButtons($val->id) !!}
									</div> <!-- end .middle-boxcol2 -->
							</div> <!-- end item index-boxcol2 -->
						</div>	<!-- end col-sm-10 -->
						<div class="col-sm-2 text-center">
							<div class="checkboxcpart">
								<input type="checkbox" value="{{$val->id}}" class="subsidyid" name="subsidyid[]" id="check_{{$val->id}}">
								<label for="check_{{$val->id}}" class="btn  btn-success  btn-style-shadow-green mgt-20 mb20">選択する</label>
							</div>
						</div><!-- end col-sm-1 -->
					</div> <!-- end .row -->
				</div> <!-- end .sidylist-item -->
				@endforeach
				<div class="clearfix"></div>
				<div class="text-center">
					{{ $results->appends(request()->query())->links() }}
				</div>

			</div> <!-- end .div.col-sm-12 -->

		</div>
		<div class="clearfix"></div>
		<div class="row mgt-30 mgbt-50">
			<div class="col-sm-12">
				<p class="text-center">
                    <button id="submit_csetbalance" type="submit" class="btn btn-success  btn-style-shadow-green">費用を設定する</button>
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