@php
	$cats = App\Modules\Asp\Models\Category::listCat();
	$request = request();
	$q_cat = $request->query('cat_id',0);
	$link = $request->url();
@endphp
<div class="navbar nav-cat">
		<ul class="nav navbar-nav">
			<li>
				<a href="{{ $link }}" class="{{ $q_cat==0 ? 'active':''}}">すべて</a>
			</li>
			@foreach ($cats as $id=>$cat)
				<li>
					<a href="{{ $link.'?cat_id='.$id }}" class="{{ $q_cat==$id ? 'active':''}}">{{ $cat }}</a>
				</li>
			@endforeach
		</ul>
</div>