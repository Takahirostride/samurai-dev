@extends('layouts.home')
@section('content')
<div class="mainpage clientprofile-1">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">アフィリエイト管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">アフィリエイト管理</h1>
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
                            <li class="tab-style-grey ">
                                <a href="{{URL::route('agency.affiliate')}}">リンク作成</a>
                            </li>                                     
                            <li class="tab-style-grey active">
                                <a href="{{URL::route('agency.affiliate.result')}}">成果統計</a>
                            </li> 
                            <li class="tab-style-grey">
                                <a href="{{URL::route('agency.affiliate.register')}}">登録情報</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12">
                            <div class="row">
                                <div class="radio col-sm-2">
                                    <label>
                                        <input type="radio" name="options" value="0" @if($op == 0) checked="" @endif>月別成果集計
                                    </label>
                                </div>
                                <div class="col-sm-2">
                                    <?php $arr_year = get_year_select(); ?>
                                    <select class="form-control" name="year1" id="year1">
                                        @if($arr_year)
                                        @foreach ($arr_year as $key => $value)
                                        <option value="{{$value}}" @if($year == $value ) selected="" @endif  >{{$value}}年</option>
                                        @endforeach
                                        @endif 

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="radio col-sm-2">
                                    <label>
                                        <input type="radio" name="options" @if($op == 1) checked="" @endif value="1">月別成果集計
                                    </label>
                                </div>
                                <div class="col-sm-2">
                                    <?php $arr_year = get_year_select(); ?>
                                    <select class="form-control" name="year" id="year" >
                                        @if($arr_year)
                                        @foreach ($arr_year as $key => $value)
                                        <option value="{{$value}}" @if($year == $value ) selected="" @endif  >{{$value}}年</option>
                                        @endforeach
                                        @endif 

                                    </select>
                                </div>
                                <div class="col-sm-2">
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
                    </div><!-- end .col-sm-12 -->
                    <div class="col-sm-12">
                        <table class="table table-bordered table-calendar-list">
                            <thead>
                                <tr>
                                    <th>日付</th>
                                    <th>ユーザー登録数</th>
                                    <th>確定成果数</th>
                                    <th>確定成果額</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($result)
                                @foreach ($result as $key => $value)
                                <tr>
                                    <td>{{$value['date']}}</td>
                                    <td>{{$value['user_count']}}件</td>
                                    <td>{{$value['final_result']}}件</td>
                                    <td>{{$value['final_result_amount']}}件</td>
                                </tr>
                                @endforeach
                                @endif 
                            </tbody>
                        </table>
                    </div>
                    <!-- end .col-sm-12 -->

			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    innit();
    $('#year,#month').on('change',function(){
            search2();             
        })
    $('#year1').on('change',function(){
            search();             
        })
    function search(){
        var year = $('#year1').val();
        var url = 'result?op=0&year='+year;
        window.location=url;
    }
    function search2(){
        var year = $('#year').val();
        var month = $('#month').val();
        var url = 'result?op=1&year='+year+'&month='+month;
        window.location=url;
    }
    $('input[name=options]').on('change',function(){
        innit();
    })
    function innit(){
        var vl = $('input[name=options]:checked').val();
        if(vl == 1){
            $('#year1').attr('disabled','');
            $('#year').removeAttr('disabled','');
            $('#month').removeAttr('disabled','');
            
        }else{
            $('#year').attr('disabled','');
            $('#month').attr('disabled','');
            $('#year1').removeAttr('disabled');
        }
    }
    
</script>	

@endsection