@php
	if(!isset($val)){return false;}
@endphp
@if($user->payroll == 0 && !$val->checkTermDisplay())
<div class="bl_policy no-display">
	<div class="bl_policy-disable"></div>	
</div>
@else
<div class="bl_policy">
	<div class="bl_policy-info">
		<div class="row flex-contain">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 col-image">
				@if($val->image_id)
				<img src="{{ asset($val->image_id) }}">
				@endif			
			</div>
			<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-info">
				<h3 class="title">
					<a href="{{ route('client.subsidy.detail',$val) }}" class="link">{{ $val->name }}</a>
				</h3>			
				<div class="meta">
					<span class="meta-desc">{{ $val->name_serve }}</span>
					<ul class="lst-inl lst-date">
						<li>
							<strong>発行機関:</strong><span>{{ $val->minitry_text() }}</span>
						</li>
						<li>
							<strong>対象地域:</strong>
							@if($val->policy_region && $val->policy_region->province)
							<span>{{$val->policy_region->province->province_name}}</span>
							@endif
						</li>
						<li>
							<strong>募集時期:</strong><span>{{str_limit($val->subscript_duration , 124)}}</span>
						</li>
					</ul>
				</div>
				<ul class="lst-inl tag-list">
					@foreach($val->tags as $tag)
					<li><span>{{str_limit($tag->tag,10)}}</span></li>
					@endforeach				
				</ul>
			</div>
		</div>		
	</div>
	<div class="bl-policy-budget">
		<div class="row">
			<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2"></div>
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
				<p class="txt-cir"><span class="circle">支援内容</span>{!! str_limit($val->support_content,50) !!}</p>
				<p class="txt-cir"><span class="circle">支援規模</span>{!! str_limit($val->support_scale,50) !!}</p>
				<p class="txt-cir"><span class="circle">施策種別</span>
					<span class="price_lable">
						{{ empty($val->acquire_budget_first) ? ' ': $val->acquire_budget_first.':' }}
						{{ $val->acquire_budget_display  }}
					</span>
				</p>
			</div>
		</div>
	</div>
</div>
@endif