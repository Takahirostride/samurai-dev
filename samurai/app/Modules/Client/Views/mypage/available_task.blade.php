@extends('layouts.home')
@section('style')
	<style type="text/css">
		.table-trades>tbody>tr>td {
			padding: 0;
		}
		#subcategory-list thead {
			background: #dce9f6;
			border: 1px solid #b1d6df;
		}
	</style>
	{{HTML::style('assets/common/css/profile.css')}}
@endsection
@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">希望内容</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">希望内容</h1>
				<p class="page-description">希望内容をご登録いただくと、自動で助成金・補助金検索が行える他、士業からあなたにあった助成金・補助金情報を受け取ることができます。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
            		@php ($profile_image = $user->image)
            	@else
            		@php ($profile_image = 'assets/common/images/img-user1.png')
            	@endif
				@include('Client::include.sidebar-left')
			</div>
			<div class="col-sm-8 mainpage">
				<div class="row">
					<div class="col-sm-12">
						@include('Client::includes.profile-av')
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav profile-tab-new nav-tabs">
							<li class=""><a href="{{ URL::route('client.profile') }}">プロフィール</a></li>
							<li class="active"><a href="{{ URL::route('client.profile.availabletask') }}">興味ある内容</a></li>
							<li><a href="{{ URL::route('client.profile.rating') }}">評価・実績</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						
					{{ Form::open(['method'=>'POST']) }}
						@include('partials.user.notifications')
						<div class="text-center">
							<button type="submit" class="btn btn-success btn-style-shadow-green">保存する</button>
						</div>
						
						<h4 class="pagerow-title">
							<span>興味のある内容</span>
						</h4>
						<table class="table table-bordered dtable table-condensed dcat-table">
							<tbody id="category-list">
								@foreach($categories as $k=>$in)
								@if(($k)%4 == 0 || $k == 0) <tr> @endif
									@if($k==0) <td class="dthead" rowspan="3">&nbsp;</td> @endif
									<td><div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="{{$in->id}}" id="check_list_bigcat-{{$in->id}}">{{$in->category_name}}</label></div></td>
								@if(($k+1)%4 == 0 && $k != 0) </tr> @endif

								@if(($k+1) == count($categories) && ($k+1)%4 != 0 && $k != 0)
									@for($ii = 0; $ii < (4-($k+1)%4); $ii++ )
										<td>&nbsp;</td>
									@endfor
									</tr>
								@endif
								@endforeach
							</tbody>
						</table> <!-- end table category -->
						<div id="subcategory-list">
							
						</div> <!-- end .subcat-disp -->

						<!-- table sub category -->
						
						<div class="clearfix"></div>

						
						<div class="text-center bsearch-btn-s">
							<button type="submit" class="btn btn-success btn-style-shadow-green">保存する</button>
						</div>
					{{ Form::close() }}
					</div> <!-- end .col-sm-12 -->
				</div> <!-- end .row -->
				
			</div> <!-- end .mainpage -->
			<div class="col-sm-2 sidebar-right">
				@include('Client::include.sidebar-right')
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
	<script>
		var base_url = '{{URL::to('/')}}';
	</script>
	{{ HTML::script('assets/client/js/profile-availabletask.js') }}
	{{ HTML::script('assets/common/js/profile.js') }}
@endsection