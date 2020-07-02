@php
	$request = request();
@endphp
<div class="col-md-12 bl_filter form-inline">
{!! Form::open(['url'=>$request->url(),'method'=>'get']) !!}	
<div class="row flex-contain">
	<div class="md-col col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="form-group">
			<span class="label">士業名</span>
			{!! Form::text('username',$request->query('username'),['class'=>'form-control','placeholder'=>'士業名']) !!}
		</div>
	</div>
	<div class="md-col col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="form-group">
			<span class="label">都道府県</span>
			@php
				$options = App\Modules\Admin\Models\Province::listOnlProvince();
			@endphp
			{!! Form::select('province',$options,$request->query('province'),['class'=>'form-control','placeholder'=>'すべて' ]) !!}
		</div>
	</div>
	<div class="md-col col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="form-group">
			<span class="label">最終ログイン</span>
			@php
				$options = [1=>'1カ月前',3=>'3カ月前',6=>'6カ月前'];
			@endphp
			{!! Form::select('last_login',$options,$request->query('last_login'),['class'=>'form-control','placeholder'=>'すべて' ]) !!}
		</div>
	</div>
	<div class="md-col col-xs-12 col-sm-12 col-md-12 col-lg-12">
		@php
			$ag_types = App\Modules\Admin\Models\AdminAgencyType::listAll();
			$value = $request->query('agency_type_id',null);
		@endphp
		<div class="cb_multi">
			<span class="name">士業種別</span>
			@php
				$check = ($value === 0)||($value === '0') ? true : false;
			@endphp
			<span class="ip_cbox">{!! Form::radio('agency_type_id',0,$check) !!}すべて</span>			
			@foreach ($ag_types as $opt_k=>$opt_val)
				@php
					$check = ($opt_k == $value) ? true : false;
				@endphp
				<span class="ip_cbox">{!! Form::radio('agency_type_id',$opt_k,$check) !!}{{ $opt_val }}</span>
			@endforeach	
			@php
				$check = ($value === -1 || $value === '-1') ? true : false;
			@endphp
			<span class="ip_cbox">{!! Form::radio('agency_type_id',-1,$check) !!}その他</span>		
		</div>	
	</div>
	<div class="md-col col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
			<span>{!! Form::checkbox('permission',1,$request->query('permission',0)) !!}(アカウント停止を表示)</span>
			<span><input type="submit" class="submit-blue-btn olsubmit" value="検索"></span>
	</div>
</div>
{!! Form::close()!!}
</div>	