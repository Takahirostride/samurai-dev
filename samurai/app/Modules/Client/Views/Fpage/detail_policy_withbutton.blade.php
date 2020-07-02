<div class="create-link-box-x">
		                	
							<table class="table table-bordered subsidylist subsidylist-2 index-subsidylist">
								<tbody>
									<tr>
										<td>
											@if($val->image_id)
												<img src="{{ asset($val->image_id) }}" alt="{{str_limit($val->name,34)}}">
											@endif	
										</td>
										<td>
											<p><a href="{{route('client.fselect', ['policy_id' => $val->id])}}"><span class="sidy-tbig">{{str_limit($val->name,40)}}</span></a></p>
											<p class="text-primary">
												<strong>発行機関:</strong><span>{{str_limit($val->minitry_text(),18)}}</span>/
												<strong>対象地域:</strong><span>{{str_limit($val->region_text() , 40)}}</span>
												<strong>募集時期:</strong><span>{{str_limit($val->subscript_duration , 8)}}</span>
											</p>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<ul class="tag-list">
												@if ($val->tags)
												@foreach($val->tags as $key => $tag)
												<li><span>{{$tag->tag}}</span></li>
												@endforeach
												@endif
											</ul>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<div class="row">
												<div class="col-sm-8">
													<div class="dpleft-bottom">
														<div class="dp-sp-scale">
															<span class="rounder-sp"><span></span>支援規模</span>
															{{ str_limit(strip_tags($val->support_content), 80) }}
														</div>
														<div class="dp-sp-scale">
															<span class="rounder-sp"><span></span>支援規模</span>
															{{ str_limit(strip_tags($val->support_scale), 80) }}
														</div>
														<div class="dp-sp-scale last-scale">
															<span class="rounder-sp"><span></span>施策種別</span>
															<p class="dsp-price">{!! str_limit($val->acquire_budget_display, 80) !!}</p>
														</div>

													</div>
												</div>
												<div class="col-sm-4 budget-btn-area">
													@php
													if($val->hire && !$val->hire->isEmpty()){
														$cls = 'gray';
														$onclick = 'return false;';
														$ulink = '#';
														$text = '依頼済み';
													} else {
														$cls = '';
														$ulink = URL::route('client.fselect', ['policy_id' => $val->id]);
														$onclick = '';
														$text = '見積依頼';
													}
													@endphp
													<a href="{{$ulink}}" class="btn btn-default btn-suggest {{$cls}}" onclick="{{$onclick}}">{{$text}}</a>
													{!! Button::getBookmarkButton($val) !!}
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>