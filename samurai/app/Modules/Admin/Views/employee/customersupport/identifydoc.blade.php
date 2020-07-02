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
<div >
    <div class="content">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <ul>
	                                <li><a href="{{('/admin/employee/customersupport/contact')}}">お問い合わせ対応設定</a></li>
	                                <li class="active"><a href="{{('/admin/employee/customersupport/identifydoc')}}">本人確認書類管理</a></li>
	                                <!-- <li><a href="{{('/admin/employee/customersupport/identifyphrase')}}">本人確認書類対応設定</a></li> -->
	                                <li><a href="{{('/admin/employee/customersupport/violator')}}">違反者管理</a></li>
	                                <!-- <li><a href="{{('/admin/employee/customersupport/violatorphrase')}}">違反者対応設定</a></li> -->
	                                
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>本人確認書類管理</span></div>
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

                            <div class="section-5 col-md-12" style="display:block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width:15%;">日時</th>
                                            <th style="width:15%;">送信者</th>
                                            <th style="width:15%;">対応者</th>
                                            <th style="width:20%;">ステータス</th>
                                            <th style="width:35%;">コメント</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($identify as $value)
                                        <tr class="tr_click" id="{{$value->id}}" >
                                            <td>{{ date('Y年m月d日', strtotime($value->update_at)) }}</td>
                                            <td>{{$value->displayname}}</td>
                                            <td>{{ $value->answer_name }}</td>
                                            <td><text>{{ $arr_state[$value->state] }}</text></td>
                                            <td>{{ $value->answers }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                {!! $identify->links() !!}
                            </div>

                            <div class="col-md-12" style="background:#e0dec8;height:18px;margin-top:20px;"></div>
                            <div class="col-md-12">

                                <div class="row">
                                    {{ Form::open(array('url' => 'admin/employee/customersupport/addPersonconfirmanswers', 'method' =>'POST')) }}
                                    <div class="col-md-9" style="background:#fff;">
                                        <div class="gridcell-left">
                                            <p><span id="sender_id" ></span> (送信者 ID) &nbsp; &nbsp; &nbsp; <span id="sender_name"></span> (送信者名)</p>
                                            <div class="row" style="margin-left:-40px;margin-right:-15px;">
                                                <div class="col-md-5" style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
                                                <p class="col-md-2" style="font-size:14px;width:24%;text-align:center;padding-left:0px;padding-right:0px;">本人確認書類</p>
                                                <div class="col-md-5"  style="width:38%;border-bottom:#000 1px solid;margin-top:10px;"></div>
                                            </div>
                                            <div class="row" style="margin-left:20px; margin-top: 20px;text-align:left;">
                                                <div id="download_files">
                                                    
                                                </div>
                                            </div>
                                            <div class="row" style="margin-left:-40px;margin-right:-15px;margin-top:20px;">
                                                <div class="col-md-5" style="width:100%;border-bottom:#000 1px solid;margin-top:10px;"></div>
                                            </div>
                                            <div class="row" style="margin-left:-40px;margin-right:-15px;">
                                                <div class="gridcell-left" style="padding-top:2px;">
                                                    <div class="row" style="margin-left:0px;margin-right:0px;">
                                                        <div class="col-md-4" style="background:#fff;">
                                                        	<div class="angularsl" id="template_change">
                                                                {{Form::select('template', $template)}}
		                                                    </div>  
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="gridcell-left">
                                                    <p style="font-size:14px;">件名　&nbsp; &nbsp;<span id="name_temp"></span></p>
                                                </div>

                                                <div class="gridcell-left" style="min-height:202px;border-bottom:0px;">
                                                    <p class="overflow-visible" id="text_temp"></p>
                                                    {{Form::hidden('admin_id', $admin_id)}}
                                                    {{Form::hidden('template_id')}}
                                                    {{Form::hidden('user_id')}}
                                                    {{Form::hidden('person_confirm_id')}}
                                                </div>
                                            </div>

                                        </div>
                                        <div class="gridcell-left">
                                            {{Form::submit('変更する', array("class"=>"submit-blue-btn", 'value'=>'送信する', 'name'=>'submit1','onclick'=> 'return check_field1()'))}}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                    {{ Form::open(array('url' => 'admin/employee/customersupport/addPersonconfirmanswers2', 'method' =>'POST')) }}
                                    <div class="col-md-3" style="padding-left:15px;padding-top:15px;">
                                        <p>対応者</p>
                                        <p>{{$admin_name}}</p>
                                        <p>ステータス変更</p>
                                        <p>
                                        	<div class="angularsl">
                                                {{Form::select('allow', array('1' => '承認', '0' => '未承認'))}} 
                                            </div>   
                                        </p>
                                        <p>コメント</p>
                                        <p><textarea name="answers" class="form-control" style="width:100%;" rows="10" ></textarea></p>
                                        {{Form::hidden('admin_id1', $admin_id)}}
                                        {{Form::hidden('person_confirm_id1')}}
                                        {{Form::submit('変更する', array("class"=>"submit-blue-btn", 'value'=>'変更する', 'name'=>'submit2','onclick'=> 'return check_field2()'))}}
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
</style>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#status .showoption div', function(){
            var parent_id = $(this).parent().parent().attr('id');
            var status_id = $('#'+parent_id).find('select').val();
            console.log(status_id);
            var url = '/admin/employee/customersupport/identifydoc/';
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
                    url: '/admin/employee/customersupport/getidentifybyid/'+id,
                    dataType: 'JSON',
                    success: function(json) {
                        console.log(json);
                        $('#sender_id').text(json.id);
                        $('#sender_name').text(json.name);
                        $('input[name="user_id"]').val(json.user_id);
                        $('input[name="person_confirm_id"]').val(id);
                        $('input[name="person_confirm_id1"]').val(id);
                        var list_file = JSON.parse(json.files);
                        console.log(list_file);
                        var html_file ="";
                        for (var i = 0; i < list_file.length; i++) {
                            var dow = "onclick=\"return downloaddocfile('"+list_file[i][1]+"','"+list_file[i][0]+"')\"";
                            html_file += "<p class='file_name'><span>•</span><a "+dow+" >"+list_file[i][0]+"</a></p>"; 
                        }
                        $('#download_files').html(html_file);
                        
                    }
                });
            }) 
            // get template 
            $(document).on('click', '#template_change .showoption div', function(){
                var parent_id = $(this).parent().parent().attr('id');
                var temp_id = $('#'+parent_id).find('select').val();
                console.log(temp_id);
                $.ajax({
                    url: '/admin/employee/customersupport/personconfirmtemplatebyid/'+temp_id,
                    dataType: 'JSON',
                    success: function(json) {
                        $('#name_temp').text(json.title);
                        $('#text_temp').text(json.text);
                        $('input[name="template_id"]').val(json.id);
                        console.log(json);
                    }
                });             
            })
            $(document).on('load', '#template_change .showoption div', function(){
                var parent_id = $(this).parent().parent().attr('id');
                var temp_id = $('#'+parent_id).find('select').val();
                console.log(temp_id);
                $.ajax({
                    url: '/admin/employee/customersupport/personconfirmtemplatebyid/'+temp_id,
                    dataType: 'JSON',
                    success: function(json) {
                        $('#name_temp').text(json.title);
                        $('#text_temp').text(json.text);
                        console.log(json);
                    }
                });             
            })
        })
        function get_temp_first(){
            var temp_id = $('#template_change').find('select').val();
            $.ajax({
                url: '/admin/employee/customersupport/personconfirmtemplatebyid/'+temp_id,
                dataType: 'JSON',
                success: function(json) {
                    $('#name_temp').text(json.title);
                    $('#text_temp').text(json.text);
                    console.log(json);
                }
            });   
        }
        get_temp_first();
       function check_field1(){
                if($('textarea[name="text"]').val() != '' && $('input[name="admin_id"]').val() != '' 
                      && $('input[name="faq_id"]').val() != '' && $('input[name="user_id"]').val() != '' 
                      && $('input[name="e_mail"]').val() != '' ){
                    console.log($('input[name="admin_id"]').val());
                    return true;
                }else{
                    alert('コメントを正確に入力してください')
                    return false
                }
            }
        function check_field2(){
            if($('textarea[name="answers"]').val() != '' && $('input[name="person_confirm_id1"]').val() != '' ){
                    return true;
                }else{
                    alert('コメントを正確に入力してください')
                    return false
                }
        }

        function downloaddocfile(filepath,filename){
            window.open("/admin/employee/customersupport/downloadfile/"+filepath+"/"+filename);
        }
    </script>
@endsection