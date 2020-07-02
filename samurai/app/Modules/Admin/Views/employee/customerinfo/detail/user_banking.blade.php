{!! Form::open(['class'=>'fr-disable']) !!}
@php
	$acc_name = null;
	$acc_number = null;
	$is_type_1 = false;
	$is_type_2 = false;
	$br_name = null;
	$bank_name = null;
	if(!empty($banking)){
		$acc_name = $banking->account_name;
		$acc_number = $banking->account_number;
		$is_type_1 = $banking->account_type == 1 ? true : false;
		$is_type_2 = $banking->account_type == 2 ? true : false;
		$br_name = $banking->branch_name;
		$bank_name = $banking->bank_name;
	}
@endphp
<div class="profile-reg-form text-center">
	<h4 class="pagerow-title"><span>口座情報</span></h4>
    <dl class="row">
        <dt class="col-sm-4">
            <h4>口座情報</h4>
        </dt>
        <dd class="col-sm-8">
            {{ Form::input('text', 'bank_name', $bank_name , ['class'=>'form-control']) }}
        </dd>
    </dl>	
    <dl class="row">
        <dt class="col-sm-4">
            <h4>支店名</h4>
        </dt>
        <dd class="col-sm-8">
            {{ Form::input('text', 'branch_name', $br_name , ['class'=>'form-control']) }}
        </dd>
    </dl>	
    <dl class="row">
        <dt class="col-sm-4">
            <h4>口座種別</h4>
        </dt>
        <dd class="col-sm-8">
        	<label>
	            {{ Form::radio('account_type',1, $is_type_1 ) }}
				<span>普通</span>        		
        	</label>
        	<label>
	            {{ Form::radio('account_type',2, $is_type_2 ) }}
				<span>当座</span>        		
        	</label>

        </dd>
    </dl>	
    <dl class="row">
        <dt class="col-sm-4">
            <h4>口座番号</h4>
        </dt>
        <dd class="col-sm-8">
            {{ Form::input('text', 'account_number', $acc_number , ['class'=>'form-control']) }}
        </dd>
    </dl>	
	<dl class="row">
        <dt class="col-sm-4">
            <h4>口座名義</h4>
        </dt>
        <dd class="col-sm-8">
            {{ Form::input('text', 'account_name', $acc_name , ['class'=>'form-control']) }}
        </dd>
    </dl>	
	
</div>	
{!! Form::close() !!}