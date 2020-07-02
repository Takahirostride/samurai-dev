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
			<span class="label">登録区分</span>
			@php
				$options = [0=>'事業者',1=>'士業'];
			@endphp
			{!! Form::select('manage_flag',$options,$request->query('manage_flag'),['class'=>'form-control','placeholder'=>'すべて' ]) !!}
		</div>
	</div>
	<div class="md-col col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
			<span><input type="submit" class="submit-blue-btn olsubmit" value="検索"></span>
	</div>
</div>
{!! Form::close()!!}
</div>	