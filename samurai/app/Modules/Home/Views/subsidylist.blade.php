@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/home/css/subsidylist.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="index-box-title">
					おすすめ
				</h3>
				<div class="row">
					<div class="col-sm-12 sidy-boxcol2">
							@if(!empty($result))
							@foreach($result as $val)
							<div class="create-link-box-x">
								<table class="table table-bordered subsidylist subsidylist-2">
									<tbody>
										<tr>
											<td rowspan="2">
												@if($val->image_id)
													<img src="{{ asset($val->image_id) }}" alt="{{str_limit($val->name,34)}}">
												@endif	
											</td>
											<td>
												<p><a href="{{route('subsidydetail', ['id' => $val->id])}}"><span class="sidy-tbig">{{str_limit($val->name,34)}}</span></a></p>
												<p class="text-right text-primary">
													<strong>発行機関:</strong><span>{{str_limit($val->register_insti_detail,18)}}</span>/
													<strong>対象地域:</strong><span>{{str_limit($val->region , 40)}}</span>
													<strong>募集時期:</strong><span>{{str_limit($val->subscript_duration , 8)}}</span>
												</p>
											</td>
										</tr>
										<tr>
											<td>
												<ul class="tag-list">
													@if ($val->tags)
													@foreach($val->tags as $key => $tag)
													<li><span>{{str_limit($tag->tag,10)}}</span></li>
													@endforeach
													@endif
												</ul>
											</td>
										</tr>
										<tr>
											<td style="border-right: none"></td>
											<td style="border-left: none">
												<div class="row">
													<div class="col-sm-12">
														<div class="dpleft-bottom">
															<div class="dp-sp-scale">
																<span class="rounder-sp"><span></span>支援規模</span>
																{!! str_limit($val->support_content, 80) !!}
															</div>
															<div class="dp-sp-scale">
																<span class="rounder-sp"><span></span>支援規模</span>
																{!! str_limit($val->support_scale, 80) !!}
															</div>
															<div class="dp-sp-scale">
																<span class="rounder-sp"><span></span>施策種別</span>
																<p class="dsp-price">{!! str_limit($val->acquire_budget_display, 80) !!}</p>
															</div>
														</div>
													</div>

												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							@endforeach
							@endif
						</div> <!-- end .col-sm-12 -->
					<div class="clearfix"></div>
					<div class="text-center">
						{{ $result->links() }}
					</div>
					
				</div> <!-- end .row -->
			</div> <!-- .col-sm-12 -->
		</div> <!-- end .row -->
	</div>
</div> <!-- end .mainpage -->
<div class="clearfix"></div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
		<div class="modal-content" style="height: 676.8px;">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h5 class="modal-title">マニュアル</h5>
			</div>
			<div class="modal-body">
				<iframe width="100%" height="100%" src="static-page/operationlecture.html" frameborder="0"></iframe>
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
	<script src="/assets/home/js/subsidylist.js"></script>
@endsection