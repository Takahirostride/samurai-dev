@php
	$c_ar = $company;
	$trade_dt = explode(',', $c_ar[6]);
	$es_date = empty($c_ar[7]) || class_basename($c_ar[7]) != 'Carbon' ? '' : $c_ar[7]->format('Y-m-d');
@endphp
<tr>
	<td>
		{{ @$c_ar[1] }}
	</td>
	<td>
		{{ @$c_ar[2] }}
	</td>
	<td>
		{{ @$c_ar[3] }}
	</td>	
	<td>{{ @$c_ar[4] }}</td>	
	<td>{{ @$c_ar[5] }}</td>	
	<td>
		@foreach ($trade_dt as $tr)
			@foreach ($trades as $ite)
				@if(strpos($tr,$ite) !== false)
					<span>{{ $tr }},</span>
					@continue
				@endif		
			@endforeach
		@endforeach
	</td>	
	<td>{{ $es_date  }}</td>	
	<td>{{ @$c_ar[8] }}</td>	
	<td>{{ @$c_ar[9] }}</td>	
	<td>{{ @$c_ar[10] }}</td>	
</tr>
