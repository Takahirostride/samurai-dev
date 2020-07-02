@extends('layouts.home')
@section('style')
    {{HTML::style('assets/common/css/profile.css')}}
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
						@include('Client::includes.profile-av')
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav profile-tab-new nav-tabs">
							<li class="active"><a href="{{ URL::route('agency.profile') }}">プロフィール</a></li>
							<li><a href="{{ URL::route('agency.profile.availabletask') }}">対応可能業務</a></li>
							<li><a href="{{ URL::route('agency.profile.rating') }}">評価・実績</a></li>
						</ul>
					</div>
				</div>
				{{ Form::open(['method'=>'POST', 'files'=>true, 'id'=>'profileForm']) }}
				<div class="row">
					@include('partials.user.notifications')
					<div class="col-sm-12">
						<h4 class="pagerow-title">
							<span>登録者情報</span>
						</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
							<div class="profile-reg-form text-center">
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>ユーザー名</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <h4 >{{ $user->username }}（<strong>ユーザー名</strong>）</h4>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>表示名</h4>
							        </dt>
							        <dd class="col-sm-8">
							        	{{ Form::input('text', 'displayname', $user->displayname , ['class'=>'form-control', 'placeholder'=>'表示名', 'disabled'=>'disabled']) }}
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>担当者名</h4>
							        </dt>
							        <dd class="col-sm-8">
							        	{{ Form::input('text', 'performer', $user->performer , ['class'=>'form-control', 'placeholder'=>'担当者名', 'readonly'=>true]) }}
							        </dd>
							    </dl>
							</div>
							<h4 class="pagerow-title">
							<span>事業所情報</span>
							</h4>
							<div class="profile-reg-form text-center">

							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>区分</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <label class="col-sm-4">
							            	{{Form::radio('section', 0, ($user->section==0)?true:false, ['disabled'=>'disabled'] )}} 個人
							            </label>
							            <label class="col-sm-4">
							            	{{Form::radio('section', 1, ($user->section==1)?true:false, ['disabled'=>'disabled'] )}} 法人
							            </label>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>事業所名</h4>
							        </dt>
							        <dd class="col-sm-8">
							        	{{ Form::input('text', 'company_name', $user->company_name , ['class'=>'form-control', 'placeholder'=>'株式会社サムライ', 'readonly'=>true]) }}
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>法人番号</h4>
							        </dt>
							        <dd class="col-sm-8">
							        	{{ Form::input('text', 'tax_number', $user->tax_number , ['class'=>'form-control', 'placeholder'=>'法人番号', 'readonly'=>true]) }}
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>代表者名</h4>
							        </dt>
							        <dd class="col-sm-8">
							        	{{ Form::input('text', 'representative', $user->representative , ['class'=>'form-control', 'placeholder'=>'代表者名', 'readonly'=>true]) }}
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>士業種類</h4>
							        </dt>
							        <dd class="col-sm-3">
							        	<div class="angularsl1">
							        	{{ Form::select('agency_type_id', App\Models\AgencyType::pluck('agency_type', 'id'), $user->agency_type_id, ['class'=>'form-control', 'readonly'=>true] ) }}
							        	</div>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>所在地</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <div class="col-sm-4">
							            	<div class="row angularsl1">
							            		{{ Form::select('province_id',App\Models\Province::where('is_ministry', 0)->where('order_by', 0)->pluck('province_name','id'), $user->user_location->province_id, ['class'=>'form-control form-select', 'id'=>'province_id_select', 'readonly'=>true] ) }}
									        </div>
									    </div>
									    <div class="col-sm-3">
									    	<label>
									        <input class="control-label" id="location-other" type="checkbox" disabled="disabled"> その他</label>
									    </div>
									    <div class="col-sm-5">
									    	<div class="row">
									    		{{ Form::input('text', 'province_name', $user->user_location->province_name, ['class'=>'form-control', 'placeholder'=>'所在地', 'id'=>'province_name', 'disabled'] ) }}
									        </div>
									    </div>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>市区町村</h4>
							        </dt>
							        <dd class="col-sm-8">
							            <div class="col-sm-4">
							            	<div class="row angularsl1">
							            		{{ Form::select('city_id', [], 0, ['class'=>'form-control form-select', 'id'=>'city_id_select', 'readonly'=>true] ) }}
									        </div>
									    </div>
									    <div class="col-sm-3">
									    <label>
									        <input class="control-label" id="city-other" type="checkbox" disabled="disabled"> その他</label>
									    </div>
									    <div class="col-sm-5">
									    	<div class="row">
									    		{{ Form::input('text', 'city_name', $user->user_location->city_name, ['class'=>'form-control', 'id'=>'city_name', 'placeholder'=>'市区町村', 'disabled']) }}
									        </div>
									    </div>
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>番地・建物名</h4>
							        </dt>
							        <dd class="col-sm-8">
							        	{{ Form::input('text', 'street_building_name', $user->street_building_name, ['class'=>'form-control', 'placeholder'=>'番地・建物名', 'readonly'=>true]) }}
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>電話番号</h4>
							        </dt>
							        <dd class="col-sm-8">
							            {{ Form::input('text', 'phone_number', $user->phone_number, ['class'=>'form-control', 'placeholder'=>'電話番号', 'readonly'=>true]) }}
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>FAX番号</h4>
							        </dt>
							        <dd class="col-sm-8">
							            {{ Form::input('text', 'fax', $user->fax, ['class'=>'form-control', 'placeholder'=>'FAX番号', 'readonly'=>true]) }}
							        </dd>
							    </dl>
							    <!-- <dl class="row">
							        <dt class="col-sm-4">
							            <h4>プロフィール画像</h4>
							        </dt>
							        
							        <dd class="col-sm-8">
							            <div class="input-group" >
							                {{ Form::input('text', '', $user->user_avatar_name(), ['class'=>'form-control', 'placeholder'=>'プロフィール画像', 'disabled', 'id'=>'image_val']) }}
							                <div class="input-group-btn">
							                    <label for="file" class="btn btn-primary">参照</label>
							                    <input id="file" type="file" name="profile_image" accept="image/*">
							                </div>
							            </div>
							        </dd>
							    </dl> -->

							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>URL</h4>
							        </dt>
							        <dd class="col-sm-8">
							        	{{ Form::input('text', 'url', $user->url, ['class'=>'form-control', 'placeholder'=>'URL', 'readonly'=>true]) }}
							        </dd>
							    </dl>
							    <dl class="row">
							        <dt class="col-sm-4">
							            <h4>自己紹介</h4>
							        </dt>
							        <dd class="col-sm-8" style="margin-bottom: 10px;">
							        	{{ Form::textarea('self_intro', $user->self_intro, ['class'=>'form-control', 'placeholder'=>'自己紹介', 'rows'=>6, 'readonly'=>true]) }}
							        </dd>
							    </dl>
							    <dl class="row" >
							        <div class="col-sm-4">
							            <h4>設立年月</h4>
							        </div>
							        <div class="col-sm-3">
							            <div class="form-group has-feedback">
							            	{{Form::number('estable_date_year', @estable_date_to_array(@$user->user_client->estable_date)[0], ['min'=>1, 'class'=>'form-control', 'readonly'=>true] )}}
							                <span class="form-control-feedback">年</span>
							            </div>
							        </div>
							        <div class="col-sm-2">
							            <div class="form-group has-feedback">
							                {{Form::number('estable_date_month', @estable_date_to_array(@$user->user_client->estable_date)[1], ['min'=>1, 'max'=>12, 'class'=>'form-control', 'readonly'=>true] )}}
							                <span class="form-control-feedback">月</span>
							            </div>
							        </div>
							        <div class="col-sm-2">
							            <div class="form-group has-feedback">
							                {{Form::number('estable_date_day', @estable_date_to_array(@$user->user_client->estable_date)[2], ['min'=>1, 'max'=>31, 'class'=>'form-control', 'readonly'=>true] )}}
							                <span class="form-control-feedback">日</span>
							            </div>
							        </div>
							    </dl>
							    <dl class="row">
							        <div class="col-sm-4">
							            <h4>資本金</h4>
							        </div>
							        <div class="col-sm-8">
							            <div class="form-group has-feedback">
							            	{{Form::text('capital', @$user->user_client->capital, ['placeholder'=>'資本金', 'min'=>1, 'class'=>'form-control', 'readonly'=>true] )}}
							                <span class="form-control-feedback">円</span>
							            </div>
							        </div>
							    </dl>
							    <dl class="row">
							        <div class="col-sm-4">
							            <h4>社員数</h4>
							        </div>
							        <div class="col-sm-3  text-left">
							            <h4>（正社員）</h4>
							        </div>
							        <div class="col-sm-5">
							            <div class="form-group has-feedback">
							            	{{Form::text('regular_number', @$user->user_client->regular_number, ['min'=>0, 'class'=>'form-control', 'readonly'=>true] )}}
							                <span class="form-control-feedback">人</span>
							            </div>
							        </div>
							    </dl>
							    
							    <div class="row mb20" style="margin-top: 30px;">
							    	@if(check_profile_change($user->profile_changed_from))
							    	{{Form::button('編集する', ['type'=>'button', 'class'=>'btn-warning btn btn-samurai go_to_edit'])}}
							    	@else
									{{Form::button('編集する', ['type'=>'button', 'class'=>'btn-default btn btn-samurai btn-not-edit'])}}
							    	@endif
							    </div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-2 sidebar-right">
				@include('Agency::includes.sidebar-right')
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirmModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="pedit-block">
					<img src="{{URL::to('assets/common/images/warning.png')}}" class="pw-img" alt="">
					<p>プロフィールの編集は一週間に一度しか変更できません。<br>
本日プロフィールの変更を行った場合は、次回プロフィールの変更が可能になるのは、{{ profile_date_change($user->profile_changed_from ) }}です。<br>
プロフィールの変更を行いますか？</p>
				</div>
				<div class="pbtn-area text-center">
					<button type="button" class="btn btn-samurai btn-default" data-dismiss="modal">キャンセル</button>
					<a class="btn btn-samurai btn-warning" href="{{URL::route('agency.profile.edit')}}">変更する</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="noEdit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="pedit-block">
					<img src="{{URL::to('assets/common/images/warning.png')}}" class="pw-img" alt="">
					<p>プロフィールの編集は月に一度しか変更できません。<br>
次回プロフィールの変更が可能になるのは、{{ profile_date_change($user->profile_changed_from ) }}です。<br>
ご了承のほどよろしくお願い致します。</p>
				</div>
				<div class="pbtn-area text-center">
					<button type="button" class="btn btn-samurai btn-default" data-dismiss="modal">閉じる</button>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
	<script>
		var base_url = '{{ URL::to('/') }}';
		var user_city_id = {{ $user->user_location->city_id }};
		$(document).ready(function() {
			initLocation();
			loadCityByProvince($('#province_id_select').val());
			com_num();
		});
		$('input[name="section"]').change(function() {
			com_num();
		});
		var initLocation = function() {
			if($('#province_id_select').val() == 0 && $('#province_name').val() != '')
			{
				$('#location-other').trigger('click');
			}
			if($('#city_id_select').val() == null && $('#city_name').val() != '')
			{
				$('#city-other').trigger('click');
			}
		}
		var loadCityByProvince = function(province_id) {
			if(province_id != 0 ) {
				$.ajax({
					url: base_url + '/agency/mypage/profile/loadCityByProvince',
					data: {'province_id': province_id},
					type: 'POST',
					dataType: 'json',
					success: function(json) {
						html = '';
						for(i = 0; i < json.length; i++) {
							selectss = '';
							if(json[i].id == user_city_id) selectss = ' selected';
							html += '<option value="'+json[i].id+'"'+selectss+'>'+json[i].city_name+'</option>';
						}
						$('#city_id_select').html(html);

					}
				})
			}
		}
		$('#province_id_select').change(function(event) {
			loadCityByProvince($('#province_id_select').val());
		});
		$('#location-other').click(function(event) {
			if($(this).is(':checked'))
			{
				$('#province_name').prop('disabled', false);
				$('#province_id_select').prop('disabled', true);
				$('#city_id_select').prop('disabled', true);
				$('#city_name').val('');
			} else {
				$('#province_name').prop('disabled', true);
				$('#province_id_select').prop('disabled', false);
				$('#city_id_select').prop('disabled', false);
				$('#city-other').prop('checked', false);
				$('#city_name').prop('disabled', true);
				$('#city_name').val('');
				$('#province_name').val('');
				
			}
			loadCityByProvince($('#province_id_select').val());
		});
		$('#city-other').click(function(event) {
			if($(this).is(':checked'))
			{
				$('#city_id_select').prop('disabled', true);
				$('#city_name').prop('disabled', false);
			} else {
				$('#city_id_select').prop('disabled', false);
				$('#city_name').prop('disabled', true);
			}
		});
		$(document).on('change', '#file', function() {
			var fileInput = document.getElementById('file');   
			var filename = fileInput.files[0].name;
			$('#image_val').val(filename);
		});

		var com_num = function() {
			if($('input[name="section"]:checked').val() == 0)
			{
				$('input[name="tax_number"]').prop('disabled', true);
			} else {
				$('input[name="tax_number"]').prop('disabled', false);
			}
		}
		@if( strtotime('+30 days',strtotime($user->address_changed_from)) > time() )
		var isAlert = 1;
		var expDate = '{{ date('Y月m日d H:i:s', strtotime('+30 days',strtotime($user->address_changed_from))) }}';
		@else 
		var isAlert = 0;
		@endif

	</script>
	{{ HTML::script('assets/common/js/profile.js?v=1') }}
@endsection