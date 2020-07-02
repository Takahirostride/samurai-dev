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
				@include('Client::include.sidebar-left')
			</div>
			<div class="col-sm-10 mainpage">
                <div class="col-sm-12 clientjob-tab mb20">
                    <div class="row">
                        <ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey ">
                                <a href="{{URL::route('client.affiliate')}}">リンク作成</a>
                            </li>                                     
                            <li class="tab-style-grey">
                                <a href="{{URL::route('client.affiliate.result')}}">成果統計</a>
                            </li> 
                            <li class="tab-style-grey active">
                                <a href="{{URL::route('client.affiliate.register')}}">登録情報</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form action="" method="POST" role="form">
                        <div class="col-sm-12">
                            <h3 class="page-title">基本情報</h3>
                            <div class="row">
                                <div class="col-sm-10">
                                    <table class="full-width table-infobas mgt-20">
                                        <tbody>
                                            <tr>
                                                <th>担当者名</th>
                                                <td>
                                                    <input type="text" name="company_name" value="{{$user_info[0]->company_name}}"  class="form-control" placeholder="担当者名">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>所在地</th>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="angularsl" id="province_out">
                                                                <select name="province" id="province">
                                                                    @if($location)
                                                                    @foreach ($location as $key => $value)
                                                                    <option value="{{$value['id']}}" @if($value['id'] == $user_info[0]->province_id) selected="" @endif  >{{$value['province_name']}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="checkbox text-right mgt-0">
                                                                <label>
                                                                  <input type="checkbox" id="province_check" data-tgdis="province,province_name"> その他
                                                                </label>
                                                              </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="province_name" id="province_name" class="form-control" placeholder="所在地" readonly="">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>市区町村</th>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <div class="angularsl" id="city_out">
                                                                <select name="city" id="city">
                                                                    
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="checkbox text-right mgt-0">
                                                                <label>
                                                                  <input type="checkbox" id="city_check" > その他
                                                                </label>
                                                              </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="city_name" id="city_name" class="form-control" placeholder="所在地" readonly="">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>番地・建物名</th>
                                                <td>
                                                    <input type="text" class="form-control" value="{{$user['street_building_name']}}" name="street_building_name" placeholder="番地・建物名">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>電話番号</th>
                                                <td>
                                                    <input type="text" name="phone_number" value="{{$user_info[0]->phone_number}}" class="form-control" placeholder="電話番号">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>FAX番号</th>
                                                <td>
                                                    <input type="text" name="fax" value="{{$user_info[0]->fax}}" class="form-control" placeholder="FAX番号">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!-- end .col-sm-10 -->
                            </div><!-- end .row -->
                            <h3 class="page-title">振込先口座情報</h3>
                            <p class="mgt-30">※ 獲得した報酬を振り込む銀行口座を登録してください。</p>
                            <div class="row">
                                <div class="col-sm-10">
                                    <table class="table table-bordered tableformtitle">
                                        <tbody>
                                            <tr>
                                                <th>銀行名</th>
                                                <td>
                                                    <div class="col-sm-4">
                                                        <div class="angularsl" id="bank_select1">
                                                            <select name="" id="bank_select">
                                                                @if($bank_info)
                                                                @foreach ($bank_info as $key => $value)
                                                                <option value="{{$value->id}}_{{$value->bank_name}}_{{$value->bank_code}}" @if($value->id == $user_info[0]->bank_id) selected @endif > {{$value->bank_name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            <input type="hidden" name="bank_id"  value="{{$user_info[0]->bank_id}}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="bank_name" id="bank_name" value="{{$user_info[0]->bank_name}}" class="form-control" placeholder="" readonly="">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>銀行コード</th>
                                                <td>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="bank_code" id="bank_code" value="{{$user_info[0]->bank_code}}"  class="form-control" placeholder="" readonly="">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table><!-- end table -->
                                    <table class="table table-bordered tableformtitle">
                                        <tbody>
                                            
                                            <tr>
                                                <th>支店名</th>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="branch_name" value="{{$user_info[0]->branch_name}}" class="form-control" placeholder="">
                                                    </div>
                                                </td>
                                                <th>支店コード</th>
                                                <td>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="branch_code" value="{{$user_info[0]->branch_code}}" class="form-control" placeholder="">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>口座種別</th>
                                                <td colspan="3">
                                                    <div class="col-sm-2">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="account_type" @if($user_info[0]->account_type == 1)checked="" @endif value="1"> 普通
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label class="radio-inline">
                                                            <input type="radio" name="account_type" @if($user_info[0]->account_type == 2)checked="" @endif value="2"> 当座
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>口座番号</th>
                                                <td colspan="3">
                                                    <div class="col-sm-12">
                                                        <input type="text" name="account_number" value="{{$user_info[0]->account_number}}" class="form-control" placeholder="">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>口座名義</th>
                                                <td colspan="3">
                                                    <div class="col-sm-12">
                                                        <input type="text" name="account_name" value="{{$user_info[0]->account_name}}" class="form-control" placeholder="">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table><!-- end table -->
                                    <p>※ 振込日が土日祝日など弊社定休日の場合は、翌営業日に振込させて頂きます。あらかじめご了承ください。</p>
                                    <div class="text-center mgbt-50 mgt-30">
                                        {{ csrf_field() }}
                                        <button type="submit" name="submit" class="shadowbuttonsuccess btn btn-success">登録する</button>
                                    </div>
                                </div><!-- end .col-sm-12 -->
                            </div><!-- end .row -->
                            
                        </div><!-- end .col-sm-12 -->
                    </form>
                    <!-- end form -->
			</div> <!-- end .mainpage -->
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">

    $(document).ready(function(){
        var city_innit = '{{$user_info[0]->city_id}}';
        $(document).on('click', '#bank_select1 .showoption div', function(){
            var parent_id = $(this).parent().parent().attr('id');
            var status_id = $('#'+parent_id).find('select').val();
            var arr_bank = status_id.split("_");

            if(arr_bank[2] == "" && arr_bank[1] == "その他" ){
                $('#bank_name').removeAttr( "readonly" );
                $('#bank_code').removeAttr( "readonly" );
                $('#bank_name').val( "" );
                $('#bank_code').val( "" );
                $('input[name="bank_id"]').val(arr_bank[0]);
            }else{
                $('#bank_name').val(arr_bank[1]);
                $('#bank_code').val(arr_bank[2]);
                $('#bank_name').attr( "readonly", "" )
                $('#bank_code').attr( "readonly", "")
                $('input[name="bank_id"]').val(arr_bank[0]);
            } 
                        
        })
        $(document).on('click', '#province_out .showoption div', function(){
        var parent_id = $(this).parent().parent().attr('id');
        var status_id = $('#'+parent_id).find('select').val();
        setTimeout(function() {
                $('.showoption').removeClass('active');
        }, 100);

        innit();  
        
        })
        $(document).on('click', '#city_out .showoption div', function(){
            var parent_id = $(this).parent().parent().attr('id');
            var status_id = $('#'+parent_id).find('select').val();
            var name = $("#city option:selected").text();
            $('#city_name').val(name);   

            // innit();  
            
        })
        function innit(){
        var province = $('#province').val();
        var name = $("#province option:selected").text();
        var bank_info = $('#bank_select').val();
        bank_info = bank_info.split("_");
        get_sub_local_ajax(province); 
        
        // $('#city').val(city_innit);
        console.log(city_innit);
        var bank_id = $('#bank_select').val();
        var arr_bank = bank_id.split("_");
        if(arr_bank[2] == "" && arr_bank[1] == "その他" ){
            $('#bank_name').removeAttr( "readonly" );
            $('#bank_code').removeAttr( "readonly" );  
        }
        $('#province_name').val(name);      
        }
        function get_sub_local_ajax(city_id){
        $.ajax({
                url: '/client/mypage/get_sub_local_ajax?city_id='+city_id,
                dataType: 'JSON',
                success: function(json) {
                    var select_op = "";
                    var checked ="";
                    for (var i = 0 ; i < json.length; i++) {
                        if(json[i]['id'] == city_innit){
                            checked = "selected=''";
                            $('#city_name').val(json[i]['city_name'])
                        }else{
                            checked = "";
                        }
                        select_op += '<option value="'+json[i]['id']+'" '+checked+' >'+json[i]['city_name']+'</option>';
                    }
                    $('#city').html(select_op);
                    setupselect();
                }
            });
        }
        $(document).on('click', '#province_check', function(){
            var obj = $(this);
                var isDisabled = $(obj).is(':checked');
                console.log(isDisabled);
                if (isDisabled) {
                    $('#province').prop('disabled', true);
                    $('#province_name').prop('readonly', false);
                } else {
                    $('#province').prop('disabled', false);
                    $('#province_name').prop('readonly', true);
                }
            });
        $(document).on('click', '#city_check', function(){
            var obj = $(this);
                var isDisabled = $(obj).is(':checked');
                console.log(isDisabled);
                if (isDisabled) {
                    $('#city').prop('disabled', true);
                    $('#city_name').prop('readonly', false);
                } else {
                    $('#city').prop('disabled', false);
                    $('#city_name').prop('readonly', true);
                }
            });
        innit();
     })
    
    

    function updateinfos(){

        if(($('#bank_name').val() == "") ||
           ($('#bank_code').val() == "") || 
           ($('#accountname').val() == "") || 
           ($('#accountnumber').val() == "")){
            alert("すべての項目を正確に入力してください!");
            return false;
        }

        if(($('#bank_select').val() == "") && ($('#bank_name').val() != "ゆうちょ銀行")){
            alert("すべての項目を正確に入力してください!");
            return false;
        }

        return true;
    }

    
</script>	

@endsection