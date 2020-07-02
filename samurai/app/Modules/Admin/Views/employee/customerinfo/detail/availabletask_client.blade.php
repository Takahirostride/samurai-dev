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
<table class="table table-bordered dtable tb-subcat table-condensed">
	<thead>
		<tr>
			<th colspan="2">{{ $sub_cats['ite_name'] }}</th>
			<th>チェック</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($sub_cats['children'] as $k_ite=>$ite)
			@php
				if(empty($ite)){ continue;}
				$is_check = $user->userCategory->contains('sub_category_id',$k_ite);
			@endphp
			<tr> 
				<td>Q</td>
				<td>{{ $ite }}</td>		
				<td>
					<div class="checkbox"><label>
						<input type="checkbox" class="bigcat cbcheck" name="category[{{ $sub_cats['id'] }}][]" value="{{$k_ite}}" {{ $is_check ? 'checked':'' }}>
					</label></div>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endif
@endforeach
{!! Form::close() !!}