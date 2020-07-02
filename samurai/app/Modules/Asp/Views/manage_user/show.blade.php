@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            @include('Asp::manage_user.menu')
            <div class="bl-csv">
            	{!! Form::open(['id'=>'fr-csv']) !!}
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">会社名/事業所名</span><span class="required">必須</span></p>
            		</div>
            		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            			{!! Form::text('company_name',$client->company_name,['required','class'=>'form-control']) !!}
            			<div class="help-block with-errors"></div>
            		</div>            		            		
            	</div>
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            		<p class="control-label"><span class="name">都道府県</span><span class="required">必須</span></p>
	            	</div>
	            	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            		@php
            			$prv = $client->userLocation ? $client->userLocation->provinceName() :'';
            		@endphp
            		{!! Form::selectMinitry('province',$prv,['required']) !!}
            		<div class="help-block with-errors"></div>
	            	</div>
            	</div>
				<div class="row form-group">
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            		<p class="control-label"><span class="name">市区町村</span><span class="required">必須</span></p>
	            	</div>
	            	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            		@php
            			$city = $client->userLocation ? $client->userLocation->cityName() :'';
            		@endphp
            		{!! Form::selectSubMinitry('city',$city,['required']) !!}
            		<div class="help-block with-errors"></div>
	            	</div>
            	</div>
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            		<p class="control-label"><span class="name">業種</span><span class="required">必須</span></p>
	            	</div>
	            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            		<div class="box-trade">
            			<div class="row">
            			@foreach ($trades as $key=>$trade)
            				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            					<label>
            						<input type="checkbox" name="trade[]" value="{{ $key }}" {{ $client->trade->contains('id',$key)?'checked':'' }}>
            						<span>{{ $trade }}</span>
            					</label>
            				</div>
            			@endforeach            				
            			</div>					
            		</div>
            		<div class="help-block with-errors"></div>
            		</div>
            	</div>	
            	<div class="row form-group">
            		@php
            			$year = null;$month = null;$day=null;
            			if($client->data && !empty($client->data->estable_date)){
            				$time = $client->data->estable_date;
            				$year = $time->year;
            				$month = $time->month;
            				$day = $time->day;
            			}
            		@endphp
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">設立年月</span><span class="required">必須</span></p>
            		</div>
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			{!! Form::number('estable_date[year]',$year,['required','class'=>'form-control','min'=>1]) !!}
            			<span>年</span>
            			<div class="help-block with-errors"></div>
            		</div>
            		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            			{!! Form::number('estable_date[month]',$month,['required','class'=>'form-control','min'=>1,'max'=>12]) !!}
            			<span>年</span>
            			<div class="help-block with-errors"></div>
            		</div>
            		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            			{!! Form::number('estable_date[day]',$day,['required','class'=>'form-control','min'=>1,'max'=>31]) !!}
            			<span>年</span>
            			<div class="help-block with-errors"></div>
            		</div>            		           		
            	</div>
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">資本金</span><span class="required">必須</span></p>
            		</div>
            		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            			@php
            				$price = $client->data ? $client->data->capital :null;
            			@endphp
            			{!! Form::number('capital',$price,['required','class'=>'form-control','min'=>0]) !!}
            			<div class="help-block with-errors"></div>
            		</div>            		            		
            	</div>  
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">従業員数</span><span class="required">必須</span></p>
            		</div>
            		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            			@php
            				$employee = $client->data ? $client->data->regular_number :null;
            			@endphp
            			{!! Form::number('regular_number',$employee,['required','class'=>'form-control','min'=>0]) !!}
            			<div class="help-block with-errors"></div>
            		</div>            		            		
            	</div>  
            	<div class="text-center">
            		<button type="submit" class="btn btn-primary">登録</button>
            	</div>           	         				
            	{!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection            
@push('script')
	<script src="{{ asset('assets/common/plugins/bootstrap/js/validator.min.js') }}"></script>	
	@include('Asp::manage_user.show_script')
@endpush