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
			<span class="label">ステータス</span>
			@php
				$options = App\Modules\Admin\Models\Report::STATE_LIST;
			@endphp
			{!! Form::select('state',$options,$request->query('state'),['class'=>'form-control','placeholder'=>'すべて' ]) !!}
		</div>
	</div>
	<div class="md-col col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="cb_multi">
			<span class="name">登録区分</span>
			@php
				$qr_type = $request->query('section');
				$type_company = $qr_type == 1 ? true : false;
				$type_person = ($qr_type === 0 || $qr_type === '0')  ? true : false;
			@endphp
			<span class="ip_cbox">{!! Form::radio('section',1,$type_company) !!}法人</span>		
			<span class="ip_cbox">{!! Form::radio('section',0,$type_person) !!}個人</span>		
		</div>	
	</div>
	<div class="md-col col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
			<span>{!! Form::checkbox('permission',1,$request->query('permission',0)) !!}(アカウント停止を表示)</span>
			<span><input type="submit" class="submit-blue-btn olsubmit" value="検索"></span>
	</div>
</div>
{!! Form::close()!!}
</div>	