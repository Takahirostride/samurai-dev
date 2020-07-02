@extends('layouts.home')
@section('style')
	<style type="text/css">

	</style>
@endsection
@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">支払い管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">支払い管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				@if($user->image)
					@php ($profile_image = $user->image) @endphp
				@else
					@php ($profile_image = 'assets/common/images/img-user1.png') @endphp
				@endif
				@include('Client::include.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
                <div class="col-sm-12 clientjob-tab mb20">
                    <div class="row">
                        <ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey active">
                                <a href="{{URL::route('client.payment')}}">入出金履歴</a>
                            </li>                                     
                            <li class="tab-style-grey">
                                <a href="{{URL::route('client.payment.support_management')}}">支払管理</a>
                            </li> 
                            <li class="tab-style-grey">
                                <a href="{{URL::route('client.payment.withdrawal')}}">出金管理</a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{ Form::open(array('url' => 'payment', 'method' =>'GET')) }}
                <div class="row">
                    <div class="col-sm-2">
                        <select class="form-control" name="pay_type" id="pay_type">
                            <option value="0" @if($pay_type == 0) selected="" @endif>すべて</option>
                            <option value="1" @if($pay_type == 1) selected="" @endif>入金</option>
                            <option value="2" @if($pay_type == 2) selected="" @endif>出金</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-2">
                        <div class="mglr-sp-15">
                        	<?php $arr_year = get_year_select(); ?>
                            <select class="form-control" name="year" id="year">
                            	@if($arr_year)
								@foreach ($arr_year as $key => $value)
								<option value="{{$value}}" @if($year == $value ) selected="" @endif  >{{$value}}年</option>
								@endforeach
								@endif 

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="mglr-sp-15">
                        	<?php $arr_mon = get_mon_select(); ?>
                            <select class="form-control" name="month" id="month">
                            	<option value="0" @if($month == $value ) selected="" @endif >月はすべて</option> 
                            	@if($arr_mon)
								@foreach ($arr_mon as $key => $value)
								<option value="{{$value}}" @if($month == $value ) selected="" @endif>{{$value}}月</option>
								@endforeach
								@endif 

                            </select>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <div class="row">
                    <div class="col-sm-12 mgt-20">
                        <table class="table table-bordered table-hover" style="margin-bottom: 20px"> 
                            <thead class="div-style-blue2"> 
                                <tr> 
                                    <th >番号</th> 
                                    <th >日付</th> 
                                    <th >概要</th>
                                    <th >入金</th> 
                                    <th >出金</th> 
                                    <th >残高</th> 
                                    <th >状況</th> 
                                </tr>                                 
                            </thead>                             
                            <tbody> 
                            	@if($result)
								@foreach ($result as $key => $value)
                                <tr>
                                    <td>{{$value->order_id}}</td> 
                                    <td>{{ date('Y年m月d日', strtotime($value->created_time)) }}</td> 
                                    <td>{{$value->summary}}</td> 
                                    <td>@if($value->input_balance > 0) {{$value->input_balance}}円 @endif</td>
                                    <td>@if($value->output_balance > 0) {{$value->output_balance}}円 @endif</td>
                                    <td>@if($value->remain_balance > 0) {{$value->remain_balance}}円 @endif</td>
                                    <td>{{$pay_status[$value->status]}}</td>
                                </tr>
                                @endforeach
								@endif                           
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row text-center">
                	{!! $result->links() !!}
                </div>

			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	 $('#pay_type,#year,#month').on('change',function(){
        	search();             
        })
	function search(){
		var pay_type = $('#pay_type').val();
		var year = $('#year').val();
		var month = $('#month').val();
		var url = 'payment?pay_type='+pay_type+'&year='+year+'&month='+month;
		window.location=url;
	}
</script>	

@endsection