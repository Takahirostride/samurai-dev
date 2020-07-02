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
				@include('Agency::includes.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
                <div class="col-sm-12 clientjob-tab mb20">
                    <div class="row">
                        <ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey">
                                <a href="{{URL::route('agency.payment')}}">入出金履歴</a>
                            </li>                                     
                            <li class="tab-style-grey active">
                                <a href="{{URL::route('agency.payment.support_management')}}">支払管理</a>
                            </li> 
                            <li class="tab-style-grey ">
                                <a href="{{URL::route('agency.payment.withdrawal')}}">出金管理</a>
                            </li>
                        </ul>
                    </div>
                </div>
                {{ Form::open(array('url' => '/agency/mypage/payment', 'method' =>'GET')) }}
                <div class="row">
                    <div class="col-sm-2">
                        <select class="form-control" name="status" id="status">
                            <option value="0" @if($status == 0) selected="" @endif>すべて</option>
                            <option value="1" @if($status == 1) selected="" @endif>未払い</option>
                            <option value="2" @if($status == 2) selected="" @endif>支払済</option>
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
                {{ Form::open(array('url' => '/pay', 'method' =>'POST')) }}
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12 mgt-20">
                        <table class="table table-bordered table-hover" style="margin-bottom: 20px"> 
                            <thead class="div-style-blue2"> 
                                <tr> 
                                    <th></th>
                                    <th >番号</th> 
                                    <th >日付</th>
                                    <th >概要</th> 
                                    <th >名目</th> 
                                    <th >金額</th> 
                                    <th >状況</th> 
                                </tr>                                 
                            </thead>                             
                            <tbody> 
                            	@if($result)
								@foreach ($result as $key => $value)
                                <tr>
                                    <td>@if($value->paid_status == 0) <input type="checkbox" class="check_" name="payment_id[]" value="{{$value->id}}">@endif </td>
                                    <td>{{$value->order_id}}</td> 
                                    <td>{{ date('Y年m月d日', strtotime($value->created_time)) }}</td> 
                                    <td>{{$value->summary}}</td>
                                    <td>{{$value->summary_sub}}</td>
                                    <td>@if($value->balance > 0) {{$value->balance}}円 @endif</td>
                                    <td>{{$getStatus[$value->status]}}</td>
                                </tr>
                                @endforeach
								@endif                           
                            </tbody>
                        </table>

                    </div>
                    <div class="col-sm-12 box-agen-green mb20">
                        <input type="hidden" name="back_page_name" value="支払い管理へ">
                        <input type="hidden" name="back_link" value="{{URL::route('agency.payment.support_management')}}">
                        <p>下記より、お支払い画面に進み、支払を完了してください。<br>
                            ※着手金の支払いの場合、支払い完了すると、業務を開始することができます。</p>
                        <p class="text-center"><input type="submit" name="submit" id="click-btn" value="選択した料金を支払う" class="btn-primary btn btn-style-shadow-green btn-success"></p>
                    </div>
                </div>
                {{ Form::close() }}
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
	 $('#status,#year,#month').on('change',function(){
        	search();             
        })
	function search(){
		var status = $('#status').val();
		var year = $('#year').val();
		var month = $('#month').val();
		var url = 'support_management?status='+status+'&year='+year+'&month='+month;
		window.location=url;
	}
    $('#click-btn').click(function(){
        var group_checkbox =  $("input[name='payment_id[]']:checked");
        if(group_checkbox.length == 0){
            alert("一つ以上の士業を選択してください。");
            return false;
        }else{
            return true;

        }
    })
    $('check_').click(function(){
        group_checkbox =  $("input[name='payment_id[]']:checked");
        if(group_checkbox.length > 10){
            dialog('<b>ポップアップ</b>','1度に依頼するきる士業は最大で10個です。', '確認');
            return false;
        }
    })
</script>	


@endsection