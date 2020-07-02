@extends('layouts.admin')
@section('style')
		<link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars.css') }}">
		<link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars-o.css') }}">
    	<link media="all" type="text/css" rel="stylesheet" href="{{ asset('assets/common/plugins/bar-rating/yellow.css') }}">

@endsection
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
    @include('Admin::partials.breadcrumb',['pagename'=>'システム管理'])
@endsection
@section('content')
<div class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        @include('Admin::employee.customerinfo.sidebar')
                    </div>
{!! Form::open(['url'=>route('admin.StaffPolicyController.update',$user),'data-toggle'=>'validator','class'=>'fr-validator']) !!}                    
<div class="col-md-9 pull-right">
<div class="site-content olcbBlue olradBlue">
	<div class="blueheading"><span>(士業名)</span></div>
	<div class="add-container">
		<div class="tbrow">
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">メール</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					<button type="button" class="submit-blue-left" style="width:100px;">メールする</button>
				</div>
			</div>
		</div>
		</div>
	</div>
	<p style="font-size:20px;margin-left:15px;">基本情報</p>
	<div class="add-container">
		<div class="tbrow">
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">区分</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right" style="height:40px;">
					<label class="col-sm-3">
		                <input class="control-label" type="radio" value="0" name="section" aria-invalid="false" style="" {{ $user->section===0 ? 'checked="checked"' : '' }}>        個人
		            </label>
		            <label class="col-sm-3">
		                <input class="control-label" type="radio" value="1" name="section" aria-invalid="false" style="" {{ $user->section===1 ? 'checked="checked"' : '' }}>        法人
		            </label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">顧客ID</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right" style="height:40px;">
					<b>{{ $user->id }}</b>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">ユーザー名</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right" style="height:40px;">
					<b>{{ $user->username }}</b>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">表示名</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					<div class="form-group">
					{!! Form::text('displayname',$user->displayname,['class'=>'form-control','required']) !!}
					<div class="help-block with-errors"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">メールアドレス</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right" style="height:40px;">
					<b>{{ $user->e_mail }}</b>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">担当者名</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::text('performer',$user->performer,['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">士業種類</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right form-inline">
						{!! Form::select('agency_type_id',App\Modules\Admin\Models\AdminAgencyType::listAll(),$user->agency_type_id,['class'=>'form-control']) !!}
		        </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">所在地<br>（書士会登録番号）</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right" style="height:60px;">
					{!! Form::text('agency_register_number',$user->agency_register_number,['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">所在地（都道府県）</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right" style="height:40px;">
					<div class="row-15">
					<div class="col-sm-3">
					@php
						$province =$user->userLocation ? $user->userLocation->province_id : null;
						$province_name =$user->userLocation ? $user->userLocation->province_name : null;

					@endphp						
						{!! Form::selectMinitry('location_sel',$province,['class'=>'form-control olCboxDisable select_minitry','data-input'=>'province_name','data-box'=>'#other_province']) !!}
					</div>
		            <div class="col-sm-2">
		                <input class="control-label" type="checkbox" aria-invalid="false" id="other_province" {{ $province_name ? 'checked':'' }}><span>その他</span>        
		            </div>
		            <div class="col-sm-4">
		                {!! Form::text('province_name',$province_name,['class'=>'form-control olCboxControl','readonly'=>'readonly','placeholder'=>'所在地','data-box'=>'#other_province']) !!} 
		            </div>
		            </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">所在地（市区町村）</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right" style="height:40px;">
					@php
						$city =$user->userLocation ? $user->userLocation->city_id : null;
						$city_name =$user->userLocation ? $user->userLocation->city_name : null;
					@endphp
					<div class="row-15">
					<div class="btn-group col-sm-3">
						{!! Form::selectSubMinitry('city_sel',$city,['class'=>'form-control olCboxDisable','data-input'=>"city_name",'data-box'=>'#other_city']) !!}
					</div>
		            <div class="col-sm-2">
		                <input class="control-label" type="checkbox" aria-invalid="false" id="other_city" {{ $city_name ? 'checked':'' }}><span>その他</span>
		            </div>
		            <div class="col-sm-4">
		                {!! Form::text('city_name',$city_name,['class'=>'form-control olCboxControl','readonly'=>"readonly",'placeholder'=>"市区町村",'data-box'=>'#other_city']) !!}
		            </div>
		            </div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">所在地（その他）</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::text('street_building_name',$user->street_building_name,['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">電話番号</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::text('phone_number',$user->phone_number,['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">FAX番号</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::text('fax',$user->fax,['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">URL</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::text('url',$user->url,['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3" style="height:220px;">
				<div class="gridcell-left">
					<p style="font-size:14px;position: relative;top:40%;">自己紹介</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::textarea('self_intro',$user->self_intro,['class'=>'form-control'])!!}
				</div>
			</div>
		</div>
		</div>
	</div>
	<p style="font-size:20px;margin-left:15px;">
		<span>振込先口座情報&nbsp;&nbsp;</span></p>
	<div class="add-container" id="bank-bl">
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">銀行名</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::text('bank[bank_name]',($user->accountInfo ? $user->accountInfo->bank_name : null ),['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">支店名</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::text('bank[branch_name]',($user->accountInfo ? $user->accountInfo->branch_name : null ),['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">口座種別</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right" style="height:40px;">
					<div class="row">
						<div class="col-md-12">
							@php
								$type = $user->accountInfo ? $user->accountInfo->account_type : 0;
							@endphp
					    	<label>
				                <input type="radio" value="1" name="bank[account_type]" class="ng-pristine" aria-invalid="false"  {{ $type==1?'checked="checked"' : '' }}>
				                普通&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
				             </label>
				             <label>
				                <input type="radio" value="2" name="bank[account_type]" class="ng-pristine" aria-invalid="false" {{ $type==2?'checked="checked"' : '' }}>
				                当座&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
				             </label>
					  	</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">口座番号</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::text('bank[account_number]',($user->accountInfo ? $user->accountInfo->account_number : null ),['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">口座名義</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					{!! Form::text('bank[account_name]',($user->accountInfo ? $user->accountInfo->account_name : null ),['class'=>'form-control']) !!}
				</div>
			</div>
		</div>
	</div>
	<p style="font-size:20px;margin-left:15px;">アカウント設定</p>
	<div class="add-container">
		<div class="row">
			<div class="col-md-3" style="height:140px;">
				<div class="gridcell-left">
					<p style="font-size:14px;position:relative;top:40%;">会員区分</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right" style="height:35px;">
					<input type="radio" name="sectionuser" value="0" class="ng-pristine" aria-invalid="false" {{ $user->personPhone === 0 ? 'checked="checked"':'' }}>無料会員 &nbsp; &nbsp; &nbsp;
				</div>
				<div class="gridcell-right" style="height:35px;">
					<input type="radio" name="sectionuser" value="1" class="ng-pristine" aria-invalid="false" {{ $user->personPhone === 1 ? 'checked="checked"':'' }}>特別有料会員 &nbsp; &nbsp; &nbsp;
				</div>			
				<div class="gridcell-right" style="height:35px;">
					<input type="radio" name="sectionuser" value="2" class="ng-pristine" aria-invalid="false" {{ $user->personPhone === 2 ? 'checked="checked"':'' }}>認定会員 &nbsp; &nbsp; &nbsp;
				</div>
				<div class="gridcell-right" style="height:35px;">
					<input type="radio" name="sectionuser" value="3" class="ng-pristine" aria-invalid="false" {{ $user->personPhone === 3 ? 'checked="checked"':'' }}>アカウント停止 &nbsp; &nbsp; &nbsp;
				</div>
			</div>
		</div>
	</div>
	<p style="font-size:20px;margin-left:15px;">評価設定</p>
	<div class="add-container">
		<div class="row">
			<div class="col-md-3">
				<div class="gridcell-left">
					<p style="font-size:14px;">評価確認・編集</p>
				</div>
			</div>
			<div class="col-md-9">
				<div class="gridcell-right">
					<a data-toggle="modal" href='#user-rating' class="submit-blue-left" style="width:100px;">確認・編集</a>
				</div>
			</div>
		</div>
	</div>
	<div style="margin-top:50px;">
      <input type="submit" name="submit" class="submit-blue-btn" value="保存">
    </div>
</div>
</div> 
{!! Form::close() !!} 
                </div>
            </div>
        </div>
    </div>
</div>                  	
@endsection
@section('script')
@include('Admin::employee.customerinfo.modal_rating') 
@endsection