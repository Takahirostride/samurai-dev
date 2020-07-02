<div class="djob-navbar">
	<a href="{{URL::route('agency.recruitment')}}" class="@if(Route::currentRouteName()=='agency.recruitment') active @endif ">進んでいる案件</a>
	<a href="{{URL::route('agency.recruitment.received')}}" class="@if(Route::currentRouteName()=='agency.recruitment.received') active @endif ">依頼が来た案件 @if($receiveCount) <span class="badge">{{$receiveCount}}</span> @endif</a>
	<a href="{{URL::route('agency.recruitment.requested')}}" class="@if(Route::currentRouteName()=='agency.recruitment.requested') active @endif ">提案した案件 @if($requestCount) <span class="badge">{{$requestCount}}</span> @endif</a>
	<a href="{{URL::route('agency.recruitment.finished')}}" class="@if(Route::currentRouteName()=='agency.recruitment.finished') active @endif ">終了した案件</a>
</div>