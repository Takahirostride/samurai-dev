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
	                                <li><a href="{{('/admin/employee/customersupport/violator')}}">違反者管理</a></li>
	                                <!-- <li><a href="{{('/admin/employee/customersupport/violatorphrase')}}">違反者対応設定</a></li> -->
	                                <li class="active"><a href="{{('/admin/employee/customersupport/manageadvertise')}}">広告掲載管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            
                            <div class="section-2 col-md-12">
                                {{ Form::open(array('url' => 'admin/employee/customersupport/manageadvertise/', 'method' =>'GET')) }}
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-horizontal ng-pristine ng-valid">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">案件ID</p>
                                                <div class="col-sm-7">
                                                	<div class="angularsl">
                                                        {{Form::select('sub_status', array('1' => 'すべて') )}}
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-horizontal ng-pristine ng-valid">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">キーワード</p>
                                                <div class="col-sm-7">
                                                     {{Form::text('keyword','', array("class" => "form-control",'placeholder'=>'キーワード'))}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <div class="row" style="margin-top: 20px;">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-horizontal ng-pristine ng-valid ng-valid-min ng-valid-max">
                                            <div class="form-group">
                                                <p class="col-sm-3">更新日</p>
                                                <div class="col-sm-3" style="padding-right:0px;">
                                                     {{Form::number('startyear','', array("class" => "form-control", 'min'=>'2017',"id" =>"startyear"))}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('startmonth','', array("class" => "form-control","name" =>"startmonth", 'min'=>'1','max'=>"12","id" =>"startmonth" , 'style'=>'padding-right:0px;padding-left:4px;'))}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('startday','', array("class" => "form-control","name" =>"startday", 'min'=>'1','max'=>"31","id" =>"startday" , 'style'=>'padding-right:0px;padding-left:4px;'))}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-horizontal ng-pristine ng-valid ng-valid-min ng-valid-max">
                                            <div class="form-group">
                                                <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">~</p>
                                                <div class="col-sm-3" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('endyear','', array("class" => "form-control","name" =>"endyear", 'min'=>'2017',"id" =>"endyear"))}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                     {{Form::number('endmonth','', array("class" => "form-control","name" =>"endmonth", 'min'=>'1','max'=>"12","id" =>"endmonth" , 'style'=>'padding-right:0px;padding-left:4px;'))}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                     {{Form::number('endday','', array("class" => "form-control","name" =>"endday", 'min'=>'1','max'=>"31","id" =>"endday" , 'style'=>'padding-right:0px;padding-left:4px;'))}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-5">
                                        <div class="form-horizontal">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">ステータス</p>
                                                <div class="col-sm-7">
                                                	<div class="angularsl">
                                                        {{Form::select('status', array('4' => 'すべて','0' => '掲載依頼','1' => '掲載中','2' => '掲載不可','3' => '掲載終了',) )}}
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-top:50px;">
                                    {{Form::submit('検索する', array("class"=>"submit-blue-btn", "name"=>"search"))}}
                                </div>
                                 {{ Form::close() }}
                                  {{ Form::open(array('url' => 'admin/employee/customersupport/changeStatusitemall/', 'method' =>'POST')) }}
                                <div class="section-3 col-md-12">
                                    <h4>広告掲載管理</h4>
                                    <div class="section3-full">
                                        <div class="section3-full-scroll">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>
                                                    <input type="checkbox" id="check_all"  @if(isset($status[4])) checked="checked" @endif >すべて &nbsp; &nbsp; &nbsp;
                                                    </label>
                                                    <label>
                                                    <input type="checkbox" class="all_check" @if(isset($status[0])) checked="checked" @endif >掲載依頼 &nbsp; &nbsp; &nbsp;
                                                    </label>
                                                    <label>
                                                    <input type="checkbox" class="all_check" @if(isset($status[1])) checked="checked" @endif>掲載中 &nbsp; &nbsp; &nbsp;
                                                    </label>
                                                    <label>
                                                    <input type="checkbox" class="all_check" @if(isset($status[2])) checked="checked" @endif>掲載不可 &nbsp; &nbsp; &nbsp;
                                                    </label>
                                                    <label>
                                                    <input type="checkbox" class="all_check" @if(isset($status[3])) checked="checked" @endif>掲載終了 &nbsp; &nbsp; &nbsp;
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-top:30px;">
                                                <div class="col-sm-3">
                                                	<div class="angularsl">
                                                        {{Form::select('status1', array('1' => '掲載許可','2' => '掲載不可','3' => '削除') )}}
                                                    </div>   
                                                </div>
                                                <div class="col-sm-2">
                                                    {{Form::submit('適用', array("class"=>"submit-blue-btn", 'value'=>'適用', 'name'=>'submit2'))}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pos-right ng-binding">@if ($result){{$result->count()}}@endif件表示 / @if ($result){{$result->total()}}@endif件</div>
                                    </div>
                                </div>

                                <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th style="min-width:120px;">許可設定</th>
                                                <th style="min-width:120px;">ステータス</th>
                                                <th style="min-width:130px;">日時</th>
                                                <th style="min-width:130px;">施策名</th>
                                                <th style="min-width:150px;"> ユーザーID</th>
                                                <th style="min-width:250px;">掲載内容</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $value)
                                            <tr>
                                                <td><input type="checkbox" name="yes[]" value="{{$value->id}}" >
                                                    {{Form::hidden('re_link', $re_link)}}</td>
                                                <td>
                                                    <div class="col-sm-6">
                                                        <button id="on{{$value->id}}" class="@if($value->ad_status == 1){{'submit-blue-left'}} @else {{'submit-white-left'}} @endif" style = "width: 80px; outline: none;" type="button" onclick="return clickchangestatusitem('{{$value->id}}','1')" >掲載許可</button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button id="off{{$value->id}}" class="@if($value->ad_status == 2){{'submit-red-left'}} @else {{'submit-white-left'}} @endif" style = "width: 80px; outline: none;" type="button" onclick="return clickchangestatusitem('{{$value->id}}','2')" >掲載不可</button>
                                                    </div>
                                                </td>
                                                <td>{{$getstatusstring[$value->ad_status]}}</td>
                                                <td>{{$value->created_at}}</td>
                                                <td><a href="/admin/employee/customersupport/advertiseedit/{{$value->user_id}}">{{$value->policy_name}}</a></td>
                                                <td><a href="/admin/employee/customersupport/advertiseedit/{{$value->user_id}}">{{$value->user_id}}</a></td>
                                                <td><a href="/admin/employee/customersupport/advertisemessage/{{$value->seller_id}}">{{$value->content}}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                {{ Form::close() }}
                                <div class="pagination">
                                    @if ($result)
                                    {!! $result->links() !!}
                                    @endif
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
    .section3-full label{
        width: auto;
        font-weight: normal;
    }
    table td a{
        text-decoration: none;
        color: #333;
    }
    table td a:focus, table td a:hover{
        text-decoration: none;
        color: #555;
    }
</style>
@endsection
@section('script')
    <script>
        function clickchangestatusitem(id , status){
            $.ajax({
                url: '/admin/employee/customersupport/changestatusitem?id='+id+'&status='+status,
                dataType: 'JSON',
                success: function(json) {
                    console.log(json);
                    if(json){
                        if(status == 2){
                        $('#on'+id).removeClass('submit-blue-left');
                        $('#off'+id).removeClass(' submit-white-left');
                        $('#on'+id).addClass('submit-white-left');
                        $('#off'+id).addClass('submit-red-left');
                        }
                        if(status == 1){
                            $('#on'+id).addClass('submit-blue-left');
                            $('#off'+id).addClass(' submit-white-left');
                            $('#on'+id).removeClass('submit-white-left');
                            $('#off'+id).removeClass('submit-red-left');
                        }
                    }    
                }
            });
        } 
        $('#check_all').click(function(){
            if($('#check_all').is(':checked')){
                $(".all_check").attr ( "checked" ,"checked" );
            }
            else{
                $(".all_check").removeAttr('checked');
            }
            
        })
    </script>
@endsection