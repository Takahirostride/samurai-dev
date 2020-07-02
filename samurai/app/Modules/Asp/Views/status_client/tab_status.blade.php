@php
	$rt_name = Route::currentRouteName();
@endphp
<nav class="navbar navbar-default nav_blue" role="navigation" id="tab-status">
		<div class="collapse navbar-collapse">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>			
			<ul class="nav navbar-nav">
				<li><a href="{{ route('asp_status_client_recruitment',$client) }}" class="{{ preg_match('/recruitment$/',$rt_name)?'active':'' }}">申請中の案件</a></li>
				<li><a href="{{ route('asp_status_client_request',$client) }}" class="{{ preg_match('/request$/',$rt_name)?'active':'' }}">見積依頼した案件</a></li>
				<li><a href="{{ route('asp_status_client_request_job',$client) }}" class="{{ preg_match('/request_job$/',$rt_name)?'active':'' }}">仕事依頼した案件</a></li>
				<li><a href="{{ route('asp_status_client_finish',$client) }}" class="{{ preg_match('/finish$/',$rt_name)?'active':'' }}">終了した案件</a></li>
				<li><a href="{{ route('asp_status_client_visit',$client) }}" class="{{ preg_match('/visit$/',$rt_name)?'active':'' }}">閲覧した案件</a></li>
				<li><a href="{{ route('asp_status_client_favorite',$client) }}" class="{{ preg_match('/favorite$/',$rt_name)?'active':'' }}">お気に入り<span class="ico"><span class="fas fa-star"></span></span></a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
</nav>