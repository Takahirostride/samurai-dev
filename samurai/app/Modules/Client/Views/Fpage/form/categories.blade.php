@php
	if(!isset($categorys)){ return false;}
	$request = request();
	$sl_cat = $request->query('category',[]);
	$sl_subcat = $request->query('categorysubs',[]);
@endphp
<div class="row">
	@foreach($categorys as $index => $category)
		<div class="col-sm-4">
			<div class="checkbox"><label><input type="checkbox" class="bigcat" name="category[]" value="{{$category['id']}}" sub-id="sub_{{$category['id']}}" {{ in_array($index,$sl_cat)?'checked':'' }}>{{$category['ite_name']}}</label></div>
		</div>
	@endforeach
</div>
<div class="text-right mgbt-20">
	<button type="button" data-check="bigcat" class="check_all btn btn-default btn-lg mgr-20">全選択</button>
	<button type="button" data-check="bigcat" class="un_check_all btn btn-default btn-lg mgr-20">全解除</button>
</div>
@foreach($categorys as $index => $category)
@if(@$category['children'])
<table id="sub_{{$category['id']}}" class="table table-bordered dtable table-condensed dcat-table subcattable">
	<tbody>
		<tr>
			<th colspan="4">{{$category['ite_name']}}</th>
		</tr>
		<tr>
			@php
				$c_sub=0;
			@endphp
			@foreach($category['children'] as $k_sub => $categorysub)
			<td>
				<div class="checkbox"><label><input type="checkbox" class="subcat" name="categorysubs[]" value="{{$k_sub}}" id="check_list_bigcat-{{ $k_sub }}" {{ in_array($k_sub,$sl_subcat)?'checked':"" }}>{{$categorysub}}</label></div>
			</td>
			@php $num = $c_sub+1;$c_sub++; @endphp
			@if($num % 4 == 0) </tr><tr> @endif	
			@endforeach
		<tr>
			<td colspan="4" class="dright-el dbg-gray"><div class="checkbox"><label><input type="checkbox" value="sub_{{$category['id']}}" class="check_list_all_sub">全選択</label></div></td>
		</tr>
	</tbody>
</table> <!-- end table category -->
@endif
@endforeach
