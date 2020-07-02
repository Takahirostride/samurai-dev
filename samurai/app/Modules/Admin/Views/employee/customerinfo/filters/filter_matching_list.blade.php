@php
	$request = request();
	$c_year = (int)date('Y');
	$k_years = range(2015,($c_year + 2));
	$years =[];
	foreach($k_years as $k=>$ite){
		$k_ite = $ite < 10 ? "0{$ite}":$ite;
		$years[$k_ite]=$k_ite;
	}
	$k_months = range(1,12);
	$months=[];
	foreach($k_months as $k=>$ite){
		$k_ite = $ite < 10 ? "0{$ite}":$ite;
		$months[$k_ite]=$k_ite;
	}
	$s_year = $request->query('s_year',2017);
	$e_year = $request->query('e_year',2017);
@endphp
<div class="col-md-12 bl_filter form-inline pd0">
	{!! Form::open(['url'=>$request->url(),'method'=>'get']) !!}
		<table class="table oltb_border olradBlue">
			<tbody>
				<tr>
					<th>マッチング日</th>
					<td>
						<div class="tb-contain tb-date">
							<div class="tb-cell">
								<span class="ip_year">
									{!! Form::select('s_year',$years,$s_year,['class'=>'form-control']) !!}
								</span>
								<span class="ip_month">
									{!! Form::select('s_month',$months,$request->query('s_month',null),['class'=>'form-control','placeholder'=>'月を指定する']) !!}
								</span>
							</div>
							<div class="tb-cell">
								<span>〜</span>
							</div>
							<div class="tb-cell">
								<span class="ip_year">
									{!! Form::select('e_year',$years,$e_year,['class'=>'form-control']) !!}
								</span>
								<span class="ip_month">
									{!! Form::select('e_month',$months,$request->query('e_month',null),['class'=>'form-control','placeholder'=>'月を指定する']) !!}
								</span>								
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<th>フリーワード</th>
					<td>
						{!! Form::text('keyword',$request->query('keyword',null),['class'=>'form-control']) !!}
					</td>
				</tr>
				<tr>
					<th>終了報告</th>
					<td>
						@php
							$finish_flag = $request->query('finish_flag',null);
						@endphp
						<div class="form-group">	
						<div class="cb_multi">
							<span class="ip_cbox">
								<input type="radio" name="finish_flag" value="0" {{( $finish_flag === 0 || $finish_flag === '0') ? 'checked' : ''}}>
								<span>あり</span>	
							</span>
							<span class="ip_cbox">
								<input type="radio" name="finish_flag" value="1" {{( $finish_flag == 1) ? 'checked' : ''}}>
								<span>なし</span>	
							</span>

						</div>
						</div>						
					</td>
				</tr>
				<tr>
					<th>着手金</th>
					<td>
						<div class="form-group">  	
						<div class="cb_multi">
							<span class="ip_cbox">
								<input type="radio" name="deposit_setting" value="">
								<span>すべて</span>	
							</span>
							<span class="ip_cbox">
								<input type="radio" name="deposit_setting" value="0">
								<span>未払い</span>	
							</span>
							<span class="ip_cbox">
								<input type="radio" name="deposit_setting" value="1">
								<span>エスクロー</span>	
							</span>
							<span class="ip_cbox">
								<input type="radio" name="deposit_setting" value="2">
								<span>支払済</span>	
							</span>							
						</div>
						</div>						
					</td>
				</tr>
				<tr>
					<th>後払い</th>
					<td>
						<div class="form-group">  	
						<div class="cb_multi">
							<span class="ip_cbox">
								<input type="radio" name="deposit_setting_1" value="">
								<span>すべて</span>	
							</span>
							<span class="ip_cbox">
								<input type="radio" name="deposit_setting_1" value="0">
								<span>未払い</span>	
							</span>
							<span class="ip_cbox">
								<input type="radio" name="deposit_setting_1" value="1">
								<span>エスクロー</span>	
							</span>
							<span class="ip_cbox">
								<input type="radio" name="deposit_setting_1" value="2">
								<span>支払済</span>	
							</span>							
						</div>
						</div>						
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="filter_sb">
							<input type="submit" class="submit-blue-btn" value="検索">
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>