<div class="dpleft no-dpright">
										<div class="dpleft-top">
											<div class="dp-top-image">
												<img src="{{URL::to($selectedHire->policy->image_id)}}" alt="">
											</div> <!-- end .dp-top-image -->
											<div class="dp-top-meta">
												<h2 class="dp-title"><a href="{{URL::route('subsidydetail', [$selectedHire->policy_id] )}}">{{$selectedHire->policy->name}}</a></h2>
												<div class="dmeta-content">
													<p>発行機関：{{$selectedHire->policy->minitry_text()}}</p>
													<p>対象地域：{{$selectedHire->policy->region_text()}}</p>
													<p>募集時期：{{str_limit($selectedHire->policy->subscript_duration, 20)}}</p>
												</div>
												<div class="dmeta-tags">
													@foreach($selectedHire->policy->tags as $tag)
													<a href="{{URL::route('subsidydetail', [$selectedHire->policy_id] )}}" class="dptag">{{$tag->tag}}</a>
													@endforeach
												</div> <!-- end .dmeta-tags -->
											</div> <!-- end .dp-top-meta -->
										</div> <!-- end .dpleft-top -->
										<div class="dpleft-bottom">
											<div class="dp-sp-content">
												<span class="rounder-sp"><span></span>支援内容</span>
												<p>{{str_limit(strip_tags($selectedHire->policy->support_content), 100)}}</p>
											</div>
											<div class="dp-sp-scale">
												<span class="rounder-sp"><span></span>支援規模</span>
												<p>{{str_limit(strip_tags($selectedHire->policy->support_scale), 100)}}</p>
											</div>
											<div class="dp-sp-price">
												<span class="rounder-sp"><span></span>施策種別</span>
												<p class="dsp-price">{{$selectedHire->policy->acquire_budget_text()}}</p>
											</div>
										</div> <!-- end .dpleft-bottom -->
									</div> <!-- end .dpleft -->