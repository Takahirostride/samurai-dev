@extends('layouts.home')
@section('style')
	<style type="text/css">
		.table-trades>tbody>tr>td {
			padding: 0;
		}
	</style>
@endsection
@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">プロフィール</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">プロフィール</h1>
				<p class="page-description">プロフィールを詳細に記載していると、通常より申請が4倍通りやすくなる傾向があります。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
            		@php ($profile_image = $user->image)
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png')
            	@endif
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-8 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<div class="profile-av">
							<div class="row">
								<div class="col-sm-4">
									{{HTML::image($profile_image, '', ['class'=>'profile-user-avatar'])}}
								</div>
								<div class="col-sm-8">
									<h4 class="main-user-name">{{$user->displayname}} ({{$user->username}})</h4>
									<p class="main-user-id">ユーザーID：{{$user->id}}</p>
									<p class="main-user-total-job">実績：　{{$user->result}}件</p>
									<div class="star-rating stars-example-fontawesome-o">
										<select class="recom-rating-disabled" data-current-rating="{{$user->evaluate}}" name="rating" autocomplete="off">
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
						</div> <!-- end .profile-av -->
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="tab-profile nav nav-tabs nav-justified">
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile') }}"> <img src="{{URL::to('assets/common/images/manual.png')}}" alt="">プロフィール</a></li>
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile.availabletask') }}"><img src="{{URL::to('assets/common/images/manual.png')}}" alt=""> 興味ある内容 </a></li>
							<li class="tab-style-grey active"><a href="{{ URL::route('agency.profile.availablesubsidy') }}">対応可能施策</a></li>
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile.rating') }}">評価・実績</a></li>
							<li class="tab-style-grey"><a href="{{ URL::route('agency.profile.cost') }}"><img src="{{URL::to('assets/common/images/manual.png')}}" alt="">費用</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4 class="pagerow-title">
							<span>カテゴリー</span>
							<a href="{{URL::to('agency/Cpart')}}" class="btn-primary btn btn-style-shadow-green btn-success right-title">新規作成</a>
							<a href="{{ URL::to('agency/Csetbalance') }}" class="btn-primary btn btn-style-shadow-green btn-success right-title">編集する</a>
						</h4>
						<div class="box-2">
							@foreach($policy_cat as $policy)
								@if(!@$policy->policy) @continue  @endif
					        		@if(@$policy->policy->matching_user->user->image)
					            		@php ($pImage = $policy->policy->matching_user->user->image)
					            	@else
					            		@php ($pImage = 'assets/common/images/img-user1.png')
					            	@endif
				        		<div class="box-scope home-policy-recomm">
				        			<div class="">
				        				<div class="col-sm-2">
				        					<div class="text-center">
				        						@php ($pImage = 'assets/common/images/img1.jpg')
				        						@if(@$policy->policy->image_id) @php ($pImage = $policy->policy->image_id)
				        						@endif
				        						{{HTML::image($pImage)}}
					                    	</div>
				        				</div>
				        				<div class="col-sm-7 ddiv-linkss">
				        					<h3 class="box-scope-title">{{ \Illuminate\Support\Str::limit($policy->policy->name, 50) }}</h3>
				        					<p class="measure_text1 ng-binding">登録機関：{{$policy->policy->minitry_text()}}/募集時期：{{\Illuminate\Support\Str::limit($policy->policy->subscript_duration, 15)}}</p>
			                                <p> {{\Illuminate\Support\Str::limit($policy->policy->target,150) }}</p>
				        				</div>
				        				<div class="col-sm-3">
				        					<div class="div-style-grey row rarting-user text-center dpolicy-post-info">
					                        @if($policy->document_business_price != 0)	書類代行　：{{$policy->document_business_price}}円<br> @endif
					                        @if($policy->document_business_price != 0)	成功報酬　：{{$policy->request_business_price}}円<br> @endif
					                        	着手金　：{{$policy->deposit_money}}円<br>
					                        	その他　：{{$policy->other_money}}円<br>
					                    	</div>
				        				</div>
				        			</div>
				        			@php ($stt1 = 0)
									@php ($stt2 = 0)
									@php ($stt3 = 0) 
				        			@foreach($policy->policy->checklist_policy_user as $val)
										@if($val->type == 0) @php ($stt1 = 1) @endif
										@if($val->type == 1) @php ($stt2 = 1) @endif
										@if($val->type == 2) @php ($stt3 = 1) @endif
				        			@endforeach
				        			<div class="col-sm-12">
				        				<div class="tooltips"><button id="recom1-{{$policy->to_id}}" data-id="{{$policy->to_id}}" onclick="setMType({{$policy->to_id}}, 0)" type="button" class="btn @if($stt1 == 1) btn-warning @else  btn-default btn-style-grey @endif">
											<strong>提案を検討</strong>
										</button>
										<p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
										</div>
										<div class="tooltips"><button id="recom2-{{$policy->to_id}}" data-id="{{$policy->to_id}}" onclick="setMType({{$policy->to_id}}, 1)" type="button" class="btn btn-default @if($stt2 == 1) btn-success @else btn-style-grey @endif">
											<strong>興味あり</strong>
											</button>
											<p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
										</div>
										<div class="tooltips"><button id="recom3-{{$policy->to_id}}" data-id="{{$policy->to_id}}" onclick="setMType({{$policy->to_id}}, 2)" type="button" class="btn btn-default @if($stt3 == 1) btn-default-select @else btn-style-grey @endif">
											<strong>非表示</strong>
											</button>
											<p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
										</div>
										<div class="btn-cost2">
			                                <label class="label-cost ng-binding">{{$policy->policy->acquire_budget_display}}</label>
			                            </div>
				        			</div>
				        		</div>
				        		@endforeach
				        		
					        </div> <!-- end .box-2 -->
					        <div class="row text-center">
								{{$policy_cat->links()}}
							</div>
							<div class="clearfix"></div>
						
					</div> <!-- end .col-sm-12 -->
				</div> <!-- end .row -->
				
			</div> <!-- end .mainpage -->
			<div class="col-sm-2 sidebar-right">
				@include('Agency::includes.sidebar-right')
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
{{ HTML::script('assets/agency/js/mypage_home.js') }}
	<script>
		var base_url = '{{URL::to('/')}}';
	</script>
@endsection