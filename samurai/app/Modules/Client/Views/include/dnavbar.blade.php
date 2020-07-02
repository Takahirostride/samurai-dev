							<div class="djob-navbar clientpage">	
								<a href="{{URL::route('client.recruitment')}}"  class="@if(Route::currentRouteName()=='client.recruitment') active @endif ">進んでいる案件</a>
								<a href="{{URL::route('client.recruitment.requested')}}"  class="@if(Route::currentRouteName()=='client.recruitment.requested') active @endif ">助成金見積もり依頼 @if($requestCount) <span class="badge">{{$requestCount}}</span> @endif</a>
								<a href="{{URL::route('client.recruitment.jobrq')}}"  class="@if(Route::currentRouteName()=='client.recruitment.jobrq') active @endif ">その他仕事依頼 </a>
								<a href="{{URL::route('client.recruitment.received')}}"  class="@if(Route::currentRouteName()=='client.recruitment.received') active @endif ">提案された案件 @if($receiveCount) <span class="badge">{{$receiveCount}}</span> @endif</a>
								<a href="{{URL::route('client.recruitment.finished')}}"  class="@if(Route::currentRouteName()=='client.recruitment.finished') active @endif ">終了した案件</a>
							</div>