@extends('layouts.home')
@section('style')
	<style type="text/css">
		.table-trades>tbody>tr>td {
			padding: 0;
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
					<li class="active">興味ある内容</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">興味ある内容</h1>
				<p class="page-description">「興味ある内容」では、助成金・補助金の申請代行で、あなたが対応可能な業種やカテゴリーなどを設定します。また、事業者への提案内容を保存しておける代行費用設定登録も
こちらで行います。</p>
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
						@include('Client::includes.profile-av')
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="nav profile-tab-new nav-tabs">
							<li class=""><a href="{{ URL::route('agency.profile') }}">プロフィール</a></li>
							<li class="active"><a href="{{ URL::route('agency.profile.availabletask') }}">対応可能業務</a></li>
							<li><a href="{{ URL::route('agency.profile.rating') }}">評価・実績</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
					{{ Form::open(['method'=>'POST']) }}
						@include('partials.user.notifications')
						<h4 class="pagerow-title">
							<span>カテゴリー</span>
							<button type="submit" class="btn btn-success btn-style-shadow-green">保存する</button>
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
								<tr>
									<td colspan="4" class="dright-el dbg-gray"><div class="checkbox"><label><input type="checkbox" value="bigcat" class="check_list_all">全選択</label></div></td>
								</tr>
							</tbody>
						</table> <!-- end table category -->
						<div id="subcategory-list">
							
						</div> <!-- end .subcat-disp -->

						<!-- table sub category -->
						
						<div class="clearfix"></div>

						<h4 class="pagerow-title">
							<span>業種</span>
						</h4>
						<div class="checkbox"><label><input type="checkbox" class="checkall_industry" id="checkall_industry">誘致関連</label></div>
						<table class="table table-bordered table-trades">
							<tbody>
								@foreach($industry as $k=>$in)
								@if(($k)%4 == 0 || $k == 0) <tr> @endif
									<td><div class="checkbox"><label><input type="checkbox" class="trades" name="trades[]" value="{{$in->id}}" @if(in_array($in->id, $user_trade)) checked="checked" @endif >{{$in->trade}}</label></div></td>
								@if(($k+1)%4 == 0 && $k != 0) </tr> @endif

								@if(($k+1) == count($industry) && ($k+1)%4 != 0 && $k != 0)
									@for($ii = 0; $ii < (4-($k+1)%4); $ii++ )
										<td>&nbsp;</td>
									@endfor
									</tr>
								@endif
								@endforeach
							</tbody>
						</table>
						
						<div class="clearfix"></div>
						<h4 class="pagerow-title">
							<span>対象地域</span>
						</h4>
						<div class="append-bsearch">
							
						</div> <!-- end .append-bsearch -->
						<div class="clearfix"></div>


						<a href="#" onclick="append_bsearch(); return false;" class="append-bsearch-link">複数選択をする</a>


						<div class="clearfix"></div>

						<!-- <h4 class="pagerow-title">
							<span>希望内容 （任意）</span>
						</h4>
						<table class="table table-bordered table-trades">
							<tbody>
								@foreach($tags as $k=>$tt)
								@if(($k)%4 == 0 || $k == 0) <tr> @endif
									<td><div class="checkbox"><label><input type="checkbox" class="tags" name="tags[]" value="{{$tt->id}}" @if(in_array($tt->id, $user_tag)) checked="checked" @endif >{{$tt->tag}}</label></div></td>
								@if(($k+1)%4 == 0 && $k != 0) </tr> @endif
								@if(($k+1) == count($tags) && ($k+1)%4 != 0 && $k != 0)
									@for($ii = 0; $ii < (4-($k+1)%4); $ii++ )
										<td>&nbsp;</td>
									@endfor
									</tr>
								@endif
								@endforeach
							</tbody>
						</table> -->

						<div class="text-center bsearch-btn-s">
							<button type="submit" class="btn btn-success btn-style-shadow-green">保存する</button>
						</div>
					{{ Form::close() }}
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
	<script>
		var base_url = '{{URL::to('/')}}';
	</script>
	{{ HTML::script('assets/agency/js/profile-availabletask.js') }}
	{{ HTML::script('assets/common/js/profile.js') }}
@endsection