@extends('Asp::layouts.asp')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            @include('Asp::layouts.partial_file.breadcrumb',['page_name'=>'manage_client_register_custom'])
            @include('Asp::manage_user.notify')
            <h3 class="tit-blue">顧客の情報</h3>
            <div class="bl-csv">
            	{!! Form::open(['route'=>['asp_manage_clients_register_store'],'id'=>'fr-csv']) !!}
                  <div class="csv-ips">
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">会社名/事業所名</span><span class="required">必須</span></p>
            		</div>
            		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            			{!! Form::text('company_name',null,['required','class'=>'form-control']) !!}
            			<div class="help-block with-errors"></div>
            		</div>            		            		
            	</div>
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            		<p class="control-label"><span class="name">都道府県</span><span class="required">必須</span></p>
	            	</div>
	            	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            		{!! Form::selectMinitry('province',null,['required']) !!}
            		<div class="help-block with-errors"></div>
	            	</div>
            	</div>
			<div class="row form-group">
                              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <p class="control-label"><span class="name">市区町村</span><span class="required">必須</span></p>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::selectSubMinitry('city',null,['required']) !!}
                        <div class="help-block with-errors"></div>
                        </div>
                  </div>
                  <div class="row form-group">
                              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <p class="control-label"><span class="name">町名・番地</span><span class="required">必須</span></p>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        {!! Form::text('street_address',null,['class'=>'form-control','required']) !!}
                        <div class="help-block with-errors"></div>
                        </div>
                  </div>
                  <div class="row form-group">
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            		<p class="control-label"><span class="name">マンション名・ビル名</span></p>
	            	</div>
	            	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            		{!! Form::text('apartment',null,['class'=>'form-control']) !!}
            		<div class="help-block with-errors"></div>
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
            						<input type="checkbox" name="trade[]" value="{{ $key }}">
            						<span>{{ $trade }}</span>
            					</label>
            				</div>
            			@endforeach
                                  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                      <button type="button" class="btn btn-cbox">
                                          <input type="checkbox" name="trade_all" value="1" class="olCheckAll" data-name="trade[]">
                                          <span>全選択</span>
                                      </button>
                                  </div>
            			</div>					
            		</div>
            		<div class="help-block with-errors"></div>
            		</div>
            	</div>	
            	<div class="row form-group">
            		@php
            			$year = null;$month = null;$day=null;
            		@endphp
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">設立年月</p>
            		</div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                              <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                          <div class="fr-inl">
                                                {!! Form::number('estable_date[year]',$year,['class'=>'form-control','min'=>1]) !!}
                                                <span>年</span>                     
                                          </div>
                                          <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                          <div class="fr-inl">
                                          {!! Form::number('estable_date[month]',$month,['class'=>'form-control','min'=>1,'max'=>12]) !!}
                                          <span>月</span>
                                          </div>
                                          <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                          <div class="fr-inl">
                                          {!! Form::number('estable_date[day]',$day,['class'=>'form-control','min'=>1,'max'=>31]) !!}
                                          <span>日</span>
                                          </div>
                                          <div class="help-block with-errors"></div>
                                    </div>                                    
                              </div>
                        </div>
            		           		
            	</div>
            	<div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">資本金</span><span class="required">必須</span></p>
            		</div>
            		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                              <div class="gr-label">
                                   {!! Form::text('capital',null,['required','class'=>'form-control olNumber','pattern'=>'[0-9,]*']) !!} 
                                   <span>円</span>
                              </div>
            			
            			<div class="help-block with-errors"></div>
            		</div>            		            		
            	</div>  
            	<div class="row form-group">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                              <p class="control-label"><span class="name">従業員数</span><span class="required">必須</span></p>
                        </div>
                        <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                              <div class="gr-label">
                                  {!! Form::text('regular_number',null,['required','class'=>'form-control olNumber','pattern'=>'[0-9,]*']) !!}  
                                  <span>人</span>
                              </div>
                              
                              <div class="help-block with-errors"></div>
                        </div>                                                
                  </div>  
                  <div class="row form-group">
            		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            			<p class="control-label"><span class="name">メールアドレス</span></p>
            		</div>
            		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
            			{!! Form::email('email',null,['class'=>'form-control']) !!}
            			<div class="help-block with-errors"></div>
            		</div>            		            		
            	</div>  
                  </div>      
            	<div class="text-center">
            		<button type="submit" class="btn btn-green btn-md" id="btnfr-save">保存する</button>
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