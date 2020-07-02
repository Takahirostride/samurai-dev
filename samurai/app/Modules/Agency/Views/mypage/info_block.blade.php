@extends('layouts.home')
@section('style')
	<style type="text/css">

	</style>
@endsection
@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">会員情報管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">会員情報管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
					@php ($profile_image = $user->image) @endphp
				@else
					@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
				@endif
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
				 <div class="col-sm-12"> 
					<div class="row">
						<div class="tab-memberinfo">
							<ul class="nav profile-tab-new nav-tabs">
								<li class=""><a href="{{URL::route('agency.memberinfo')}}">ログイン情報設定</a></li>
								<li class=""><a href="{{ URL::route('agency.memberinfo.mail') }}">メール通知設定</a></li>
								<li class="active"><a href="{{ URL::route('agency.memberinfo.block') }}">ブロック</a></li>
								<li><a href="{{ URL::route('agency.memberinfo.regmem') }}">会員登録・退会</a></li>
							</ul>
						</div>
						
						<div class="col-sm-12 form-memberinfo memberinfo-2">
							
							
								<div class="col-sm-12 form-memberinfo fist">
								@include('partials.user.notifications')
								{{Form::open(['method'=>'POST', 'url'=>URL::to('/agency/mypage/memberinfo/add-block')])}} 
									<div class="row">
										<div class="col-sm-3">
											<p>ユーザー名</p>
										</div>
										<div class="col-sm-6">
											<input type="text" id="username" placeholder="ユーザー名" class="col-sm-12" aria-invalid="false">
										</div>
											<div class="col-sm-3">
											<button type="button" onclick="doSearchUser();" class="boxshadowbuttonblue btn-right btn-primary btn">検索する</button>
										</div>
									</div> <!-- end .row -->
									
									<div class="row">
										<div class="col-xs-6 col-xs-offset-3">
											<div class="result-arr"></div>
										</div>
									</div>

									<div class="col-sm-12 box center btn-member">
										<button type="submit" onclick="return checkUncheck('input.sl-id');" class="boxshadowbuttonblue btn btn-primary btn-lg land-btn">ブロックする</button>
									</div> 
								</form>		
							</div>
							<div class="col-sm-12 form-memberinfo last">
								{{Form::open(['method'=>'POST', 'url'=>URL::to('/agency/mypage/memberinfo/remove-block')])}} 
									<div class="col-sm-3">
										<p>ブロックリスト</p>
									</div>
									<div class="col-sm-9">
										@foreach($blocked_list as $sblock)
										<div class="checkbox memberinfo-4">
											<label class="lb-mem">
												<input name="new_block_list[]" value="{{$sblock->block_id}}" class="control-label sl-blocked" type="checkbox" aria-invalid="false">{{$sblock->block->displayname}}
											</label>
										</div>
										@endforeach
									</div>

										<div class="col-sm-12 box center btn-member">
										<button type="submit" onclick="return checkUncheck('input.sl-blocked');" class="boxshadowbuttonblue btn btn-primary btn-grey btn-lg land-btn">解除する</button>
									</div> 
								{{Form::close()}}
							</div>
							
						</div> 
					</div> <!-- end .row -->
				</div> <!-- end .col-sm-12 -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
		var doSearchUser = function() {
			$.ajax({
				url: base_url + '/agency/mypage/memberinfo/block-ajax',
				data: {act: 'searchUser', username: $("#username").val()},
				type: 'POST',
				success: function(json) {
					if(json.success)
					{
						html = '';
						$.each(json.user_list, function(index, val) {
							html += '<div class="checkbox memberinfo-4"><label class="lb-mem"><input name="new_block_list[]" value="'+val.id+'" class="control-label sl-id" type="checkbox" aria-invalid="false">'+val.displayname+'</label></div>';
						});
						$('.result-arr').html(html);
					}
				}
			});
		}
		var checkUncheck = function(elements) {
			var is_checked = false;
			$(elements).each(function(index, el) {
				if($(el).is(':checked'))
				{
					is_checked = true;
					return;
				}
			});
			if(is_checked == false)
			{
				alert('一人以上のユーザーを選択してください。');
				return false;
			}
			return true;
		}
	</script>

@endsection