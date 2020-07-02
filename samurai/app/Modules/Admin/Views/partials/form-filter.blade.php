@php
	if(!isset($filters)){ return false;}
	$request = request();
@endphp
<div class="col-md-12 bl_filter form-inline">
{!! Form::open(['url'=>$request->url(),'method'=>'get']) !!}	
<div class="row flex-contain">
	@foreach ($filters as $k_ft => $ft)
		@php
			$value = $request->query($k_ft,null);
		@endphp
		<div class="md-col col-md-{{ $ft['col'] }}">
		<div class="form-group">
		@if(!is_numeric($k_ft))										
		@switch($ft['type'])
			@case('year')
				<span class="ip_year">{!! Form::number($k_ft,$value,['class'=>'form-control','min'=>2000,'step'=>1]) !!}&nbsp;&nbsp;{{ $ft['label'] }}</span>
				@break 
			@case('month')
				<span class="ip_month">{!! Form::number($k_ft,$value,['class'=>'form-control','min'=>1,'max'=>'12','step'=>1]) !!}&nbsp;&nbsp;{{ $ft['label'] }}</span>
				@break 
			@case('day')
				<span class="ip_day">{!! Form::number($k_ft,$value,['class'=>'form-control','min'=>1,'max'=>31,'step'=>1]) !!}&nbsp;&nbsp;{{ $ft['label'] }}</span>
				@break 
			@case('number')
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif	
					{!! Form::number($k_ft,$value,['class'=>'form-control number','min'=>1,'step'=>1]) !!}					
				@break
		    @case('text')		    	
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif
						{!! Form::text($k_ft,$value,['class'=>'form-control']) !!}
		        @break
			@case('select')
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif	
						@php
							$p_hold = empty($ft['placeholder']) ? '':$ft['placeholder'];
						@endphp
						{!! Form::select($k_ft,$ft['options'],$value,['class'=>'form-control','placeholder'=>$p_hold ]) !!}
				@break
			@case('onlyProvince')
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif	
					@php
						$options = App\Modules\Admin\Models\Province::listOnlProvince()
					@endphp
					{!! Form::select($k_ft,$options,$value,['class'=>'form-control','placeholder'=>'すべて' ]) !!}								
				@break	
			@case('selectProvince')
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif
					{!! Form::selectProvince($k_ft,$value) !!}				
				@break
			@case('selectCity')
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif
					{!! Form::selectCity($k_ft,$value) !!}				
				@break
			@case('selectMinitry')
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif
					{!! Form::selectMinitry($k_ft,$value) !!}				
				@break
			@case('selectSubMinitry')
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif
					{!! Form::selectSubMinitry($k_ft,$value) !!}				
				@break
			@case('selectMinitryProvince')
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif
					{!! Form::selectMinitryProvince($k_ft,$value,['data-children'=>'#sub-minity-province']) !!}				
				@break
			@case('selectSubMinitryProvince')
					@if(!empty($ft['label']))
						<span class="label">{{ $ft['label'] }}</span>
					@endif
					{!! Form::selectSubMinitry($k_ft,$value,['id'=>'sub-minity-province']) !!}				
				@break
			
			@case('checkbox')
				@php
					$check = $request->query($k_ft,false) ? true : false;
				@endphp
				@if(!empty($ft['parenthese']))<span>(</span>@endif
				<span class="ip_cbox">{!! Form::checkbox($k_ft,1,$check) !!}{{ $ft['label'] }}&nbsp;&nbsp;&nbsp;</span>	
				@if(!empty($ft['parenthese']))<span>)</span>@endif		
				@break	
			@case('multiCheckbox')
				<div class="cb_multi">
				@if(!empty($ft['checkall']))
				<span class="ip_cbox"><input type="checkbox" class="check_all olCheckAll" data-name="{{ $k_ft }}[]">すべて&nbsp;&nbsp;&nbsp;</span>
				@endif
				@foreach ($ft['options'] as $opt_k=>$opt_val)
					@php
						$check = false;
						if($request->has($k_ft)){
							$check = in_array($opt_k,$value) ? true : false;
						}
					@endphp
					<span class="ip_cbox">{!! Form::checkbox($k_ft.'[]',$opt_k,$check) !!}{{ $opt_val }}&nbsp;&nbsp;&nbsp;</span>
				@endforeach
				</div>
				@break	
			@case('column')
			@break				
		    @default
		@endswitch				
		@else
		<span class="ip_sep">{!! $ft['label'] !!}</span>	
		@endif
		</div>
		</div>
	@endforeach
</div>
@php
	$cls = (isset($button_center) && $button_center)  ? 'text-center':'';
@endphp
<div class="filter_sb {{ $cls }}">
	<input type="submit" class="submit-blue-btn" value="検索">
</div>
{!! Form::close() !!}
</div>