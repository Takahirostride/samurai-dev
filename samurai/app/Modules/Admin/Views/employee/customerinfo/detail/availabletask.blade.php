{!! Form::open(['class'=>'fr-disable']) !!}
<h4 class="pagerow-title"><span>カテゴリー</span></h4>
<table class="table table-bordered dtable table-condensed dcat-table">
	<tbody id="category-list">
		@php
			$k=0;
		@endphp
		@foreach($categories as $k_cat=>$cat)
		@php
			$k_1 = $k+1;
			$is_check = $user->userCategory->contains('category_id',$cat['id']);
		@endphp
		@if($k%4 == 0 || $k == 0) 
			<tr> 
			<td class="dthead">&nbsp;</td>	
		@endif		
		<td><div class="checkbox"><label>
			<input type="checkbox" class="bigcat cbcheck" name="category[]" value="{{$cat['id']}}" id="check_list_bigcat-{{$cat['id']}}" {{ $is_check ? 'checked':'' }}>
			{{$cat['ite_name']}}</label></div></td>
		@if($k_1%4 == 0 && $k != 0) 
			</tr> 
		@endif

		@if($k_1 == count($categories) && $k_1%4 != 0 && $k != 0)
			@for($ii = 0; $ii < (4-$k_1%4); $ii++ )
				<td>&nbsp;</td>
			@endfor
			</tr>
		@endif
		@php
			$k++;
		@endphp
		@endforeach
	</tbody>
</table> <!-- end table category -->
<h4 class="pagerow-title"><span>カテゴリー詳細</span></h4>
@php
	$s_cats = $user->userCategory->groupBy('category_id')->all();
@endphp
@foreach($s_cats as $cat_id=>$cat)
@if(array_key_exists($cat_id, $categories))
@php
	$sub_cats = $categories[$cat_id];
@endphp
<table class="table table-bordered dtable table-condensed dcat-table">
	<tbody>
		@php
			$c_sub = 0;
		@endphp
		@foreach ($sub_cats['children'] as $k_ite=>$ite)
			@php
				$c_sub_1 = $c_sub+1;
				$is_check = $user->userCategory->contains('sub_category_id',$k_ite);
			@endphp
			@if($c_sub%4 == 0 || $c_sub == 0) 
			<tr> 
				@if($c_sub==0) 
					<td class="dthead">{{ $sub_cats['ite_name'] }}</td> 
				@else
					<td class="dthead"></td>	
				@endif			
			@endif
			<td><div class="checkbox"><label>
				<input type="checkbox" class="bigcat cbcheck" name="category[{{ $sub_cats['id'] }}][]" value="{{$sub_cats['id']}}" {{ $is_check ? 'checked':'' }}>
				{{$ite}}</label></div></td>
			@if($c_sub_1%4 == 0 && $c_sub != 0) 
				</tr> 
			@endif

			@if($c_sub_1 == count($sub_cats['children']) && $c_sub_1%4 != 0 && $c_sub != 0)
				@for($ii = 0; $ii < (4-$c_sub_1%4); $ii++ )
					<td>&nbsp;</td>
				@endfor
				</tr>
			@endif			
		@php
			$c_sub++;
		@endphp
		@endforeach
	</tbody>
</table>
@endif
@endforeach
<h4 class="pagerow-title"><span>業種</span></h4>
<table class="table table-bordered table-trades">
	<tbody>
		@php
			$k = 0;
		@endphp
		@foreach($trades as $trade_id=>$trade)
		@php
			$k_1 = $k+1;
		@endphp
		@if($k%4 == 0 || $k == 0) <tr> @endif
		<td><div class="checkbox"><label><input type="checkbox" class="trades cbcheck" name="trades[]" value="{{$trade_id}}" @if($user->trade->contains('id',$trade_id)) checked="checked" @endif >{{$trade}}</label></div></td>
		@if($k_1%4 == 0 && $k != 0) </tr> @endif
		@if($k_1 == count($trades) && $k_1%4 != 0 && $k != 0)
			@for($ii = 0; $ii < (4-$k_1%4); $ii++ )
				<td>&nbsp;</td>
			@endfor
			</tr>
		@endif
		@php
			$k++;
		@endphp
		@endforeach
	</tbody>
</table>
<h4 class="pagerow-title"><span>対象地域</span></h4>
<div class="append-bsearch">
	@foreach ($user->userAddress as $address)
		<div class="row">
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<p class="address-name">{{ $address->provinceName() }}</p>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<p class="address-name">{{ $address->cityName() }}</p>
			</div>

		</div>
	@endforeach
</div>
<h4 class="pagerow-title"><span>希望内容 （任意）</span></h4>
<table class="table table-bordered table-trades">
	<tbody>
		@php
			$k=0;
		@endphp
		@foreach($tags as $tag_id=>$tag)
		@php
			$k_1 = $k+1;
		@endphp
		@if($k%4 == 0 || $k == 0) <tr> @endif
			<td><div class="checkbox"><label><input type="checkbox" class="tags cbcheck" name="tags[]" value="{{$tag_id}}" @if($user->tag->contains('id',$tag_id)) checked="checked" @endif >{{$tag}}</label></div></td>
		@if($k_1%4 == 0 && $k != 0) </tr> @endif
		@if($k_1 == count($tags) && $k_1%4 != 0 && $k != 0)
			@for($ii = 0; $ii < (4-$k_1%4); $ii++ )
				<td>&nbsp;</td>
			@endfor
			</tr>
		@endif
		@php
			$k++;
		@endphp
		@endforeach
	</tbody>
</table>
{!! Form::close() !!}