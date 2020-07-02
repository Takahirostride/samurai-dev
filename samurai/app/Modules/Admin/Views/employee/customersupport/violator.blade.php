@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">施策データ管理</a><span>&gt;</span></li>
        <li><a>顧客対応管理</a></li>
    </ul>
</div>
@endsection
@section('content')
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <ul>
	                                <li><a href="{{('/admin/employee/customersupport/contact')}}">お問い合わせ対応設定</a></li>
	                                <li><a href="{{('/admin/employee/customersupport/identifydoc')}}">本人確認書類管理</a></li>
	                                <!-- <li><a href="{{('/admin/employee/customersupport/identifyphrase')}}">本人確認書類対応設定</a></li> -->
	                                <li class="active"><a href="{{('/admin/employee/customersupport/violator')}}">違反者管理</a></li>
	                                <!-- <li><a href="{{('/admin/employee/customersupport/violatorphrase')}}">違反者対応設定</a></li> -->
	                                
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>違反者管理</span></div>
                            <div class="section-3 col-md-12" style="padding-left:0px;">
                                <div class="section3-full" style="padding-left:0px;">
                                    <div class="section3-full-scroll" style="padding-left:8px;">
                                        <div class="row">
                                            <div class="col-sm-3">
                                            	<div class="angularsl" id="status">
                                                    {{Form::select('sub_status', array('0' => 'すべて', '1' => '承認', '2' => '未承認'), $status )}}
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section-5 col-md-12" style="overflow-x:auto;display:block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="min-width:200px;">日時</th>
                                            <th style="min-width:200px;">送信者</th>
                                            <th style="min-width:200px;">違反者</th>
                                            <th style="min-width:200px;">対応者</th>
                                            <th style="min-width:200px;">アカウント停止状態</th>
                                            <th style="min-width:200px;">ステータス</th>
                                            <th style="max-width:250px;">違反内容</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($violator as $value)
                                        <tr class="tr_click" id="{{$value->id}}" >
                                            <td style="min-width:200px;">{{ date('Y年m月d日 H時i分', strtotime($value->created_date)) }}</td>
                                            <td style="min-width:200px;"> {{$value->user_name}}</td>
                                            <td style="min-width:200px;">{{$value->report_name}}</td>
                                            <td style="min-width:200px;">{{$value->correspond}}</td>
                                            <td style="min-width:200px;">{{$getAccountStatus[$value->permission]}}</td>
                                            <td style="min-width:200px;">
                                                <text>{{ $arr_state[$value->state] }}</text>    
                                            </td>
                                            <td style="max-width:250px;">{{$value->message}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                {!! $violator->links() !!}
                            </div>

                            <div class="col-md-12" style="background:#e0dec8;height:18px;margin-top:20px;"></div>
                            <div class="col-md-12">

                                <div class="row">
                                    {{ Form::open(array('url' => 'admin/employee/customersupport/updateViolation', 'method' =>'POST')) }}
                                    <div class="col-md-9" style="background:#fff;">
                                        <div class="gridcell-left">
                                            <p><span id="sender_id"></span> (送信者 ID) &nbsp; &nbsp; &nbsp; <span id="sender_name"></span> (送信者名)</p>
                                            
                                            <div class="row" style="margin-left:-40px;margin-right:-15px;">
                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
                                                <p class="col-md-2" style="font-size:14px;width:24%;text-align:center;padding-left:0px;padding-right:0px;"><span id="create-date">○○年○○月○○日</span></p>
                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
                                                <div class="row">
                                                    <p style="font-size:14px;width:200px;float:right;text-align:right;padding-left:0px;padding-right:70px;margin-top:15px;"><span id="time-string">○○:○○</span>(時間)</p>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size:14px;margin-left:65px;margin-right:65px; height:auto;" id="contents"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gridcell-left">
                                            <div class="row" style="margin-left:0px;margin-right:0px;">
                                                <div class="col-md-4" style="background:#fff;">
                                                	<div class="angularsl" id="template_change">
                                                        {{Form::select('template', $template)}}
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="gridcell-left">
                                            <p style="font-size:14px;">件名　&nbsp; &nbsp;<span id="rp_template"></span></p>
                                        </div>
                                        <div class="gridcell-left" style="height:170px;">
                                             {{Form::textarea('text','', array("class"=> "form-control", 'id'=>'rp_text', 'style' => 'width: 100%; height: 96%;'))}} 
                                        </div>
                                        <div class="gridcell-left" style="height:80px;">
                                            {{Form::hidden('admin_id', $admin_id)}}
                                            {{Form::hidden('template_id')}}
                                            {{Form::hidden('complete')}}
                                            {{Form::hidden('report_id')}}
                                            {{Form::submit('送信する', array("class"=>"submit-blue-btn top20", 'value'=>'送信する', 'name'=>'submit1', 'onclick'=>'return check_field1();'))}}
                                        </div>
                                    </div>
                                     {{ Form::close() }}
                                    <div class="col-md-3" style="padding-left:15px;padding-top:25px;">
                                        {{ Form::open(array('url' => 'admin/employee/customersupport/updateViolation2', 'method' =>'POST')) }}
                                        <p>対応者</p>
                                        <p>{{$admin_name}}</p>
                                        <p>ステータス変更</p>
                                        <p>
                                        	<div class="angularsl">
                                                 {{Form::select('allow', array('1' => 'アカウント停止', '0' => 'アカウント停止解除'))}} 
                                            </div>  
                                        </p>
                                        <p>コメント</p>
                                        <p>
                                            {{Form::textarea('answers','', array("class"=> "form-control", 'cols'=>0, 'rows'=>10, 'id' =>'rp_text2'))}} 
                                            {{Form::hidden('report_id2')}}
                                            {{Form::hidden('admin_id2', $admin_id)}}
                                        </p>
                                        {{Form::submit('変更する', array("class"=>"submit-blue-btn ", 'value'=>'変更する', 'name'=>'submit2','onclick'=> 'return check_field2()'))}}
                                    {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('style')
<style type="text/css">
    .file_name a, .tr_click{
        cursor: pointer;
    }
    .top20 {
        top: 20px;
    }
</style>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#status .showoption div', function(){
            var parent_id = $(this).parent().parent().attr('id');
            var status_id = $('#'+parent_id).find('select').val();
            console.log(status_id);
            var url = '/admin/employee/customersupport/violator/';
            if(status_id == 0){
                window.location=url;
            }else{
                window.location=url+status_id;
            }                
            })
            // get status
            $('.tr_click').click(function(){
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/employee/customersupport/getViolatorbyid/'+id,
                    dataType: 'JSON',
                    success: function(json) {
                        console.log(json);
                        var d = new Date(json.created_date);
                        var time = d.getHours() + ":" + d.getMinutes();
                        d = d.getFullYear() +'年' + (d.getMonth()+1)+"月"+d.getDate()+ "日" ;
                        $('#sender_id').text(json.user_id);
                        $('#sender_name').text(json.report_name);
                        $('#contents').text(json.message);
                        $('#create-date').text(d);
                        $('#time-string').text(time);
                        $('input[name="user_id"]').val(json.user_id);
                        $('input[name="report_id"]').val(id); 
                        $('input[name="report_id2"]').val(id); 


                    }
                });
            }) 
            // get template 
            $(document).on('click', '#template_change .showoption div', function(){
                var parent_id = $(this).parent().parent().attr('id');
                var temp_id = $('#'+parent_id).find('select').val();
                console.log(temp_id);
                $.ajax({
                    url: '/admin/employee/customersupport/getViolatortemplatebyid/'+temp_id,
                    dataType: 'JSON',
                    success: function(json) {
                        $('#rp_template').text(json.title);
                        $('input[name="template_id"]').val(json.id);
                        $('input[name="complete"]').val(json.complete);
                        $('#rp_text').val(json.text);
                    }
                });             
            })
           
        })
        function get_temp_first(){
            var temp_id = $('#template_change').find('select').val();
            console.log(temp_id);
            $.ajax({
                url: '/admin/employee/customersupport/getViolatortemplatebyid/'+temp_id,
                dataType: 'JSON',
                success: function(json) {
                    $('#rp_template').text(json.title);
                    $('input[name="template_id"]').val(json.id);
                    $('input[name="complete"]').val(json.complete);
                    $('#rp_text').val(json.text);
                }
            });   
        }
        get_temp_first();
        function check_field1(){
                if($('input[name="report_id"]').val() != ''){
                    return true;
                }else{
                    alert('コメントを正確に入力してください')
                    return false
                }
            }
        function check_field2(){
            if($('input[name="report_id2"]').val() != '' && $('#rp_text2').val() !=''){
                    return true;
                }else{
                    alert('コメントを正確に入力してください')
                    return false
                }
        }
    </script>
@endsection