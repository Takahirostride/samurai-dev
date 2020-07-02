@php
	$cats = App\Modules\Asp\Models\Category::listCat();
	$request = request();
	$q_cat = $request->query('cate',0);
	$recom = $request->query('recom_bounty',0);
	$link = $request->url();
	$location = $request->query('cate',null);
	if($location=="location") $recom=-1;
@endphp
<div class="navbar nav-cat">
		<ul class="nav navbar-nav">
			<li>
				<a href="{{ $link }}" class="{{ $q_cat==0 && $recom==0 ? 'active':''}}">すべて</a>
			</li>
			<li>
				<a href="{{ $link.'?recom_bounty=1' }}" class="{{ $recom ==1 ? 'active':''}}">おすすめ</a>
			</li>			
			@foreach ($cats as $id=>$cat)
				<li>
					<a href="{{ $link.'?cate='.$id }}" class="{{ $q_cat==$id ? 'active':''}}">{{ $cat }}</a>
				</li>
			@endforeach
			<li>
	    		<a class="{{ ($location=="location") ? 'active':'' }}" href="{{ $request->url().'?'.http_build_query(['cate'=>'location']) }}">誘致関連</a>
	    	</li>
		</ul>
</div>