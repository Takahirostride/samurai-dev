<div class="bl-feedback">
<form>	
<div class="row evaluation-list">
    <div class="col-sm-12" >
    	@foreach($feedbacks as $k=>$fb)
    		@php
    			$policy = $fb->hire && $fb->hire->policy ? $fb->hire->policy :false;
    		@endphp
        <div class="div-style-blue info-daily">
        	<div class="row">
            <div class="col-sm-2 left-img-daily">
        		<div class="form-group">
        			@php
        				$opts = [0=>'Disable',1=>'Active'];
        			@endphp
        			{!! Form::select('display[]',$opts,$fb->display,['class'=>'form-control ip-display','data-id'=>$fb->id]) !!}
        		</div>            	
                <p class="thums-img">
                	@if($policy)
                	{{HTML::image($policy->image_id)}}
                	@endif
                </p>
            </div>
            <div class="col-sm-7">
                <div class="row">
                    <div><h4 class="mprating-link">{{$policy ? $policy->name:''}}</h4>
                        <div class="star-rating fbrtdiv-{{$k}}">
							<select class="fbrtsl-{{$k}}" data-current-rating="{{$fb->eval_total}}" name="rating" autocomplete="off">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- <b>{{str_limit($fb->support_content, 50)}}</b> -->
                    <p>{{$fb->eval_message}}</p>
                    </div>
                </div>
            <div class="col-sm-3 group-raitting">
                <div class="text-center list-right-rating">
                	<p class="time-daily">{{ $fb->created_date->format('Y年m月d日')}}</p>
                    <div class="list-rating">
                        <p>品質</p>
                        <div class="star-rating fbrtdiv1-{{$k}}">
							<select class="fbrtsl1-{{$k}}" data-current-rating="{{$fb->eval_quality}}" name="rating" autocomplete="off">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
                    </div>
                    <div class="list-rating">
                        <p>納期</p>
                        <div class="star-rating fbrtdiv2-{{$k}}">
							<select class="fbrtsl2-{{$k}}" data-current-rating="{{$fb->eval_delivery}}" name="rating" autocomplete="off">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
                    </div><div class="list-rating">
                        <p>対応</p>
                        <div class="star-rating fbrtdiv3-{{$k}}">
							<select class="fbrtsl3-{{$k}}" data-current-rating="{{$fb->eval_conf}}" name="rating" autocomplete="off">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
                    </div><div class="list-rating">
                        <p>コスト</p>
                        <div class="star-rating fbrtdiv4-{{$k}}">
							<select class="fbrtsl4-{{$k}}" data-current-rating="{{$fb->eval_price}}" name="rating" autocomplete="off">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
                    </div><div class="list-rating">
                        <p>能力</p>
                        <div class="star-rating fbrtdiv5-{{$k}}">
							<select class="fbrtsl5-{{$k}}" data-current-rating="{{$fb->eval_ability}}" name="rating" autocomplete="off">
								<option value=""></option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
						</div>
                    </div>
                </div>
                
            </div>
            </div>            
        </div> <!-- end .info-daily -->
        @endforeach
    </div>
</div>
</form>
<div class="row">
	<div class="text-center">
		{{ $feedbacks->links() }}
	</div>
</div>
</div>