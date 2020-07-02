{!! Form::open(['class'=>'fr-disable']) !!}
<h4 class="pagerow-title"><span>登録者情報</span></h4>
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
        	{{ Form::input('text', 'displayname', $user->displayname , ['class'=>'form-control', 'placeholder'=>'表示名']) }}
        </dd>
    </dl>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>担当者名</h4>
        </dt>
        <dd class="col-sm-8">
        	{{ Form::input('text', 'performer', $user->performer , ['class'=>'form-control', 'placeholder'=>'担当者名']) }}
        </dd>
    </dl>
</div>
<h4 class="pagerow-title"><span>事業所情報</span></h4>
<div class="profile-reg-form text-center">

    <dl class="row">
        <dt class="col-sm-4">
            <h4>区分</h4>
        </dt>
        <dd class="col-sm-8">
            <label class="col-sm-4">
            	{{Form::radio('section', 0, ($user->section==0)?true:false )}} 個人
            </label>
            <label class="col-sm-4">
            	{{Form::radio('section', 1, ($user->section==1)?true:false )}} 法人
            </label>
        </dd>
    </dl>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>事業所名</h4>
        </dt>
        <dd class="col-sm-8">
            {{ Form::input('text', 'company_name', $user->company_name , ['class'=>'form-control', 'placeholder'=>'株式会社サムライ']) }}
        </dd>
    </dl>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>法人番号</h4>
        </dt>
        <dd class="col-sm-8">
            {{ Form::input('text', 'company_name', $user->tax_number , ['class'=>'form-control', 'placeholder'=>'法人番号']) }}
        </dd>
    </dl>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>代表者名</h4>
        </dt>
        <dd class="col-sm-8">
        	{{ Form::input('text', 'company_name', $user->representative , ['class'=>'form-control', 'placeholder'=>'代表者名']) }}
        </dd>
    </dl>
    



    <dl class="row">
        <dt class="col-sm-4">
            <h4>士業種類</h4>
        </dt>
        <dd class="col-sm-8">
        	<div class="angularsl1">
        	@php
        		$agency_type = empty($user->user_agency_type) ? '' : $user->user_agency_type->agency_type;
        	@endphp
        	{!! Form::text('agency_type_name',$agency_type,['class'=>'form-control']) !!}
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
            		@php
            			$province = $user->userLocation && empty($user->userLocation->province_name) ? $user->userLocation->provinceName() : '';
            			$is_other =  $user->userLocation && !empty($user->userLocation->province_name) ? true : false;
            			$province_other = $user->userLocation ? $user->userLocation->province_name : '';
            			$is_disable = $is_other ? false : 'disabled';
            		@endphp
            		{!! Form::text('province_name',$province,['class'=>'form-control']) !!}
		        </div>
		    </div>
		    <div class="col-sm-3">
		    	<label>
		        <input class="control-label" id="location-other" type="checkbox" {{ $is_other ? 'checked':'' }}>
		         その他</label>
		    </div>
		    <div class="col-sm-5">
		    	<div class="row">
		    		{{ Form::input('text', 'province_other_name', $province_other, ['class'=>'form-control', 'placeholder'=>'所在地', 'id'=>'province_name', 'disabled'=>$is_disable] ) }}
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
            		@php
            			$city = $user->userLocation && empty($user->userLocation->city_name) ? $user->userLocation->cityName() : '';
            			$is_other =  $user->userLocation && !empty($user->userLocation->city_name) ? true : false;
            			$city_other = $user->userLocation ? $user->userLocation->city_name : '';
            			$is_disable = $is_other ? false : 'disabled';
            		@endphp 
            		{!! Form::text('city_name',$city,['class'=>'form-control']) !!}           		
		        </div>
		    </div>
		    <div class="col-sm-3">
		    <label>
		        <input class="control-label" id="city-other" type="checkbox" {{ $is_other ? 'checked':'' }}> その他</label>
		    </div>
		    <div class="col-sm-5">
		    	<div class="row">
		    		{{ Form::input('text', 'city_other_name',$city_other, ['class'=>'form-control', 'id'=>'city_name', 'placeholder'=>'市区町村', 'disabled'=>$is_disable]) }}
		        </div>
		    </div>
        </dd>
    </dl>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>番地・建物名</h4>
        </dt>
        <dd class="col-sm-8">
        	{{ Form::input('text', 'street_building_name', $user->street_building_name, ['class'=>'form-control', 'placeholder'=>'番地・建物名']) }}
        </dd>
    </dl>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>電話番号</h4>
        </dt>
        <dd class="col-sm-8">
            {{ Form::input('text', 'phone_number', $user->phone_number, ['class'=>'form-control', 'placeholder'=>'電話番号']) }}
        </dd>
    </dl>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>FAX番号</h4>
        </dt>
        <dd class="col-sm-8">
            {{ Form::input('text', 'fax', $user->fax, ['class'=>'form-control', 'placeholder'=>'FAX番号']) }}
        </dd>
    </dl>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>URL</h4>
        </dt>
        <dd class="col-sm-8">
        	{{ Form::input('text', 'url', $user->url, ['class'=>'form-control', 'placeholder'=>'URL']) }}
        </dd>
    </dl>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>自己紹介</h4>
        </dt>
        <dd class="col-sm-8">
        	{{ Form::textarea('self_intro', $user->self_intro, ['class'=>'form-control', 'placeholder'=>'自己紹介', 'rows'=>6]) }}
        </dd>
    </dl>
    <dl class="row" >
        <div class="col-sm-4">
            <h4>設立年月</h4>
        </div>
        <div class="col-sm-3">
            <div class="form-group has-feedback">
                {{Form::number('estable_date_year', @estable_date_to_array(@$user->userClientData->estable_date)[0], ['min'=>1, 'class'=>'form-control'] )}}
                <span class="form-control-feedback">年</span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group has-feedback">
                {{Form::number('estable_date_month', @estable_date_to_array(@$user->userClientData->estable_date)[1], ['min'=>1, 'max'=>12, 'class'=>'form-control'] )}}
                <span class="form-control-feedback">月</span>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group has-feedback">
                {{Form::number('estable_date_day', @estable_date_to_array(@$user->userClientData->estable_date)[2], ['min'=>1, 'max'=>31, 'class'=>'form-control'] )}}
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
                {{Form::number('capital', @$user->userClientData->capital, ['placeholder'=>'資本金', 'min'=>1, 'class'=>'form-control'] )}}
                <span class="form-control-feedback">万円</span>
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
                {{Form::number('regular_number', @$user->userClientData->regular_number, ['min'=>0, 'class'=>'form-control'] )}}
                <span class="form-control-feedback">人</span>
            </div>
        </div>
    </dl>    
</div>
{!! Form::close() !!}