@php
	$newArr = $policyArr = $keyArr = $ccc = array();
@endphp
@foreach($recruitList as $key=>$recruit)
	@php
		if($recruit->hire_type == 2 && $recruit->policy_id == 0) {
			$newArr[$key][] = $recruit;
		} else {
			if( in_array($recruit->policy_id, $policyArr) )
			{
				$newArr[$keyArr[$recruit->policy_id]][] = $recruit;
			} else {
				$policyArr[$key] = $recruit->policy_id;
				$keyArr[$recruit->policy_id] = $key;
				$newArr[$key][] = $recruit;
			}
			
		}
	@endphp
@endforeach


@foreach($newArr as $key=>$arrRow)
	@if (count($arrRow))
	<div class="dcollapse">
		<div class="dleft-policy @if($arrRow[0]->from->manage_flag==1)dleft-blue @else dleft-green @endif ">
			<p>{{ ddate_string($arrRow[0]->deli_date) }}</p>
			<p>案件名: {{str_limit($arrRow[0]->hire_title(), 22) }}</p>
			<button type="button" class="btn-dcollapse" data-id="{{$key}}"><i class="fa fa-sort-up"></i></button>
		</div>
		<div class="dleft-policylist-{{$key}}">
		@foreach($arrRow as $key1=>$recruit)
		@if ($recruit->from_id == session('user_id'))
			@php
				$shiff_user = $recruit->to;
			@endphp
		@else
			@php
				$shiff_user = $recruit->from;
			@endphp
		@endif
			<div class="dleft-item @if($recruit->id == request()->hire_id)active @endif">
				<a href="{{URL::route(Route::currentRouteName(), [$recruit->id] )}}"></a>
				<div class="dleft-avatar recruit-shiff">
					<a class="recruit-shiffavatar" href="{{URL::route('agency.profile.view', [$shiff_user->id] )}}"></a>
					<img src="{{URL::to($shiff_user->image)}}" alt="">
				</div>
				<div class="dleft-uinfo">
					@if(stristr(Route::currentRouteName() , 'requested') ) 
						@if(in_array($recruit->id, $requestList))<span class="badge">{{@$requestSum[$recruit->id]}}</span> @endif
					@endif
					@if(stristr(Route::currentRouteName(), 'received') ) 
						@if(in_array($recruit->id, $receiveList))<span class="badge">{{@$receiveSum[$recruit->id]}}</span> @endif
					@endif
					<p class="dleft-uname">{{$shiff_user->user_name()}}</p>
					<p class="dleft-pname">案件名：{{str_limit($recruit->hire_title(), 14) }}</p>
					<p class="dleft-price">提案額：{{$recruit->deposit_money_format() . ' 円'}}</p>
				</div>
			</div> <!-- end .dleft-item -->
		@endforeach
		</div>
	</div>
	@endif
@endforeach