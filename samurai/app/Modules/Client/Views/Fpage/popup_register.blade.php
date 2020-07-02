@php
	if(!isset($policy)){return false;}
	$show = request()->filled('register') ? '1':'0'
@endphp
<div class="modal fade" id="client-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-show="{{ $show }}">
	<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
		<div class="modal-content">
			{!! Form::open(['class'=>'fr-reg','id'=>'fr_reg_data']) !!}
			<input type="hidden" name="policy_id" value="{{ $policy->id }}">
			<div class="oltab active" id="reg-step-1">
				<div class="form-group">
					<p class="control-label">募集の締め切り</p>
					<div class="input-group">
					    <input type="text" name="complete_date" class="form-control olPickDate" value="" placeholder="締切日を設定する" data-date-start-date="{{ date('Y年m月d日',time()) }}">
					    <div class="input-group-addon">
					        <span class="olicon-drop"></span>
					    </div>
					</div>
				</div>
				<div class="form-group">
					<p class="control-label">予算を設定する</p>
					@php
						//$budgets = config('client.set_budget')
					@endphp
					{{Form::select('budget', [''=>'予算を設定しない'] + config('site_config.client_budget_list'), '', ['class'=>'form-control', 'required', 'id'=>'budget1'])}}
				</div>
				<div class="form-group text-center">
					<button type="button" class="btn btn-default btn-suggest gray" data-dismiss="modal">閉じる</button>
					<button type="button" class="btn btn-default btn-suggest olCheck">確認する</button>
				</div>					
			</div>
				
			<div class="oltab" id="reg-step-2">
				<div class="form-group">
					<p class="control-label">募集の締め切り</p>
					<p class="btn-reg" id="complete_date_show"></p>
				</div>
				<div class="form-group">
					<p class="control-label">予算を設定する</p>
					<p class="btn-reg" id="title_show"></p>
				</div>				
				<div class="form-group text-center">
					<button type="button" class="btn btn-default btn-suggest gray olEdit">修正する</button>
					<button type="button" class="btn btn-default btn-suggest olSubmit">この内容で見積依頼する</button>
				</div>				
			</div>	
			<div class="oltab" id="reg-step-3">
				<div class="ol-success">
					<h3>見積もり依頼が完了いたしました。</h3>
					<p>仕事管理から事業者とSAMURAI内チャットでコンタクトを取ることができます。<br>SAMURAIでは事業者との直接のやりとりを禁止しております。予めご了承ください</p>	
					<p>下記の仕事管理画面から見積もりの状況が確認できます。</p>
					<p class="text-center">
						<button type="button" onclick="window.location.reload();" class="btn btn-default olbtn-sucess">見積もり依頼画面を見る</button>
					</p>
				</div>
				<p class="text-center">
					<button type="button" onclick="window.location.reload();" data-dismiss="modal" class="btn btn-default olbtn-close">閉じる</button>
				</p>
			</div>			
			{!! Form::close() !!}
		</div>
	</div>
</div>