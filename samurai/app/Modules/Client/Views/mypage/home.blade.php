@extends('layouts.home')
@section('style')
    {{ HTML::style('assets/common/plugins/bar-rating/dist/themes/fontawesome-stars-o.css') }}
    {{HTML::style('assets/common/css/profile.css')}}
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => 'マイページ'])
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">マイページ</h1>
				<p class="page-description">本部からのお知らせや、人気のある施策が「おすすめ」としてここに表示されます。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
            		@php ($profile_image = $user->image) @endphp
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
            	@endif
				@include('Client::include.sidebar-left')
			</div>
			<div class="col-sm-8 mainpage">
				<div class="row">
					<div class="col-sm-12">
						@include('Client::includes.profile-av')
					</div>
				</div>
		        <div class="box-noti-list">
		        	<h2 class="page-title">お知らせ</h2>
		        	<table class="table table-bordered table-home-notify">
		        		@foreach($notification as $key=>$nof)
			        		@if($key==count($notification)+1) @php ($class='last')
			        		@endif
			        	<tr>
			        		<td>{{date('Y年m月d日', strtotime($nof->created_date) )}}</td>
			        		<td><a href="{{URL::route('client.notify', [$nof->id] )}}">{{$nof->title}}</a></td>
			        	</tr>
			        	@endforeach
		        	</table>
		        	
		        	<p class="text-right "><a href="{{URL::route('client.notifylist')}}" class="link-right">すべてのお知らせを見る</a></p>
		        </div>
		        <div class="box-2">
		        	<h2 class="page-title">お勧めの案件</h2>
		        	@foreach ($homePolicy as $key => $item)
						{!! Button::showPolicyList($item, 'client.fselect') !!}
					@endforeach
	        		
		        </div> <!-- end .box-2 -->
		        <div class="row text-center">
					{{$homePolicy->links()}}
				</div>
				
				<div class="row"></div>
				<div class="box-2">
					<h2 class="page-title">案件の閲覧履歴</h2>
				@foreach ($policyHistory as $key => $item)
						{!! Button::showPolicyList($item->policy, 'client.fselect') !!}
					@endforeach
	        		
		        </div> <!-- end .box-2 -->
		        <div class="row text-center">
					{{$policyHistory->links()}}
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="col-sm-2 sidebar-right">
				@include('Client::includes.sidebar-right-home')
			</div> <!-- end .sidebar-right -->
		</div>
	</div>
</div> <!-- end .mainpage -->
@endsection
@section('script')
	{{ HTML::script('assets/client/js/mypage_home.js') }}
	{{ HTML::script('assets/common/js/profile.js') }}
	<script type="text/javascript">
		var base_url = '{{URL::to('/')}}';
		// var currentRating = $('.recom-rating-disabled').data('current-rating');

  //       $('.stars-example-fontawesome-o .current-rating')
  //           .find('span')
  //           .html(currentRating);

  //       $('.stars-example-fontawesome-o .clear-rating').on('click', function(event) {
  //           event.preventDefault();

  //           $('.recom-rating-disabled')
  //               .barrating('clear');
  //       });

  //       $('.recom-rating-disabled').barrating({
  //           theme: 'fontawesome-stars-o',
  //           showSelectedRating: false,
  //           readonly: true,
  //           initialRating: currentRating,
  //           onSelect: function(value, text) {
  //               if (!value) {
  //                   $('.recom-rating-disabled')
  //                       .barrating('clear');
  //               } else {
  //                   $('.stars-example-fontawesome-o .current-rating')
  //                       .addClass('hidden');

  //                   $('.stars-example-fontawesome-o .your-rating')
  //                       .removeClass('hidden')
  //                       .find('span')
  //                       .html(value);
  //               }
  //           },
  //           onClear: function(value, text) {
  //               $('.stars-example-fontawesome-o')
  //                   .find('.current-rating')
  //                   .removeClass('hidden')
  //                   .end()
  //                   .find('.your-rating')
  //                   .addClass('hidden');
  //           }
  //       });
	</script>
@endsection