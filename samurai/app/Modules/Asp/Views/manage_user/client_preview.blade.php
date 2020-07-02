@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            @include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'manage_client_register_custom'])
            @include('Asp::manage_user.notify')
            <h3 class="tit-blue">顧客の情報</h3>
            <div class="bl-csv">
            	{!! Form::open(['class'=>'olfrView']) !!}
                  <div class="csv-ips">
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">会社名/事業所名</span><span class="required">必須</span></p>
            		</div>
            		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            			<p>{{ $client->company_name }}</p>
            		</div>            		            		
            	</div>
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            		<p class="control-label"><span class="name">都道府県</span><span class="required">必須</span></p>
	            	</div>
	            	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            		    <p>{{ $client->userLocation ? $client->userLocation->provinceName() : '' }}</p>
	            	</div>
            	</div>
			<div class="row form-group">
                              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <p class="control-label"><span class="name">市区町村</span><span class="required">必須</span></p>
                        </div>                        
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                              <p>{{ $client->userLocation ? $client->userLocation->cityName() : '' }}</p>
                        </div>
                  </div>
                  <div class="row form-group">
                              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <p class="control-label"><span class="name">町名・番地</span><span class="required">必須</span></p>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                              <p>{{ $client->street_building_name }}</p>
                        </div>
                  </div>
                  <div class="row form-group">
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            		<p class="control-label"><span class="name">マンション名・ビル名</span></p>
	            	</div>
	            	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            		    
	            	</div>
            	</div>
                        
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            		<p class="control-label"><span class="name">業種</span><span class="required">必須</span></p>
	            	</div>
	            	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            		<div class="box-trade">
            			<div class="row">
            			@foreach ($trades as $key=>$trade)
            				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            					<label>
            						<input type="checkbox" name="trade[]" value="{{ $key }}"
                                                {{ $client->trade->contains('id',$key) ? 'checked':'' }}
                                                >
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
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">設立年月</p>
            		</div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                              <p>{{ $client->data ? ol_get_date_string($client->data->estable_date) : '' }}</p>
                        </div>      
           		           		
            	</div>
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">資本金</span><span class="required">必須</span></p>
            		</div>
                        @php
                              $cap = $client->data ? $client->data->capital : null;
                        @endphp
            		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                              @if($cap)
            			<p>{{ ol_number_display($cap) }}<span>円</span></p>
                              @endif
            		</div>            		            		
            	</div>  
            	<div class="row form-group">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                              <p class="control-label"><span class="name">従業員数</span><span class="required">必須</span></p>
                        </div>
                        @php
                              $reg_num = $client->data ? $client->data->regular_number : null;
                        @endphp
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                              @if($reg_num)
                              <p>{{ ol_number_display($reg_num) }}<span>人</span></p>
                              @endif
                        </div>                                                
                  </div>  
                  <div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">メールアドレス</span></p>
            		</div>
            		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            			<p>{{ $client->e_mail }}</p>
            		</div>            		            		
            	</div>  
                  </div>
            	<div class="text-center">
            		<a href="{{ route('asp_manage_clients_register',$client) }}" class="btn btn-green btn-md" id="btnfr-save">編集する</a>
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