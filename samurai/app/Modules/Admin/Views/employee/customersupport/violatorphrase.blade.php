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
	                                <!-- <li class="active"><a href="{{('/admin/employee/customersupport/violatorphrase')}}">違反者対応設定</a></li> -->
	                                
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>違反者用定型文管理</span></div>
                             {{ Form::open(array('url' => 'admin/employee/customersupport/delViolatorphrase/', 'method' =>'POST')) }}
                            <div class="row" style="margin-left:0px;margin-right:0px;">
                                <div class="section-5 col-md-12" style="display:block;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>選択</th>
                                                <th style="min-width:105px;">承認・未承認</th>
                                                <th style="min-width:15px;">項目名</th>
                                                <th style="min-width:60px;">件名</th>
                                                <th style="min-width:150px;">本文</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $value)
                                            <tr class="tr_click" id="{{ $value->id }}">
                                                <td><input type="checkbox" name="yes[]" value="{{ $value->id }}" ></td>
                                                <td style="max-width:105px;" >{{$displaystatusstring[$value->complete]}}</td>
                                                <td style="max-width:15px;" >{{$value->item_name}}</td>
                                                <td style="max-width:60px;" >{{$value->title}}</td>
                                                <td style="max-width:250px;">{{$value->text}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="margin-left:0px;margin-right:0px;">
                                <div class="col-md-2">
                                    {{Form::submit('削除する', array("class"=>"submit-blue-btn", 'value'=>'削除する', 'name'=>'submit1', 'onclick'=>'return check_del();'))}}
                                </div>
                                <div class="col-md-12">
                                    <div class="pagination">
                                       {!! $result->links() !!}
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                            <div class="col-md-12" style="background:#e0dec8;height:18px;margin-top:20px;"></div>
                            <div class="col-md-12" style="padding-left:50px;padding-right:50px;margin-top:30px;">
                                {{ Form::open(array('url' => 'admin/employee/customersupport/updateViolatorphrase/', 'method' =>'POST')) }}
                                
                                {{Form::submit('新規登録', array("class"=>"submit-blue-btn", 'value'=>'新規登録', 'name'=>'submit1','style'=>'position:initial;margin-left:0px;', 'onclick'=>'return resetForm();'))}}
                                <div class="add-container" style ="margin-left:0px;margin-right:0px;">
                                    <div class="row">
                                        <div class="col-md-3" style="background:#fff;">
                                            <div class="gridcell-left">
                                                <p style="font-size:14px;">承認・未承認</p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="gridcell-right" style="height:40px;">
                                                <label>
                                                    <input checked="checked" name="complete" id="op2" type="radio" value="1">承認&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                                                </label>
                                                <label>
                                                    <input name="complete" type="radio" id="op1" value="0"> 未承認&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3" style="background:#fff;">
                                            <div class="gridcell-left">
                                                <p style="font-size:14px;">項目名</p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="gridcell-right">
                                                {{Form::text('item_name','', array("class" => "form-control","name" =>"item_name"))}}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3" style="background:#fff;">
                                            <div class="gridcell-left">
                                                <p style="font-size:14px;">件名</p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="gridcell-right">
                                                 {{Form::text('title','', array("class" => "form-control","name" =>"title"))}}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3" style="height:120px;background:#fff;">
                                            <div class="gridcell-left">
                                                <p style="font-size:14px;position: relative;top:40%;">本文</p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="gridcell-right">
                                                {{Form::textarea('text','', array("class"=> "form-control", 'cols'=>0, 'rows'=>5))}} 
                                                {{Form::hidden('edit_type')}}
                                                {{Form::hidden('template_id')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top:50px;">
                                    {{Form::submit('登録する', array("class"=>"submit-blue-btn", 'value'=>'登録する', 'name'=>'submit2', 'onclick'=>'return check_field1();'))}}
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog box-in contact-modal">
        <div class="modal-content box-out">
            <div class="col-sm-12">
                <div class="box-modal">
                    <p class="font20">ポップアップ<br><b id="note-field"></b>フィールドを正確に記入してください！</p>
                    <button class="md-primary md-button md-default-theme right modal-btn-close">確認</button>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
@section('style')
<style type="text/css">
    .font20 {
        font-size:20px;
    }
    .box-modal {
        padding: 20px;
        height: 100%;
        max-width: 169px;
        width: 100%;
        max-width: 470px;
        background: #fff;
        border-radius: 10px;
        margin: auto;
        display: table;
    }
    .contact-modal {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 0;
    }
    .right{
        float: right;
    }
    .modal-btn-close {
        display: inline-block;
        position: relative;
        cursor: pointer;
        min-height: 36px;
        min-width: 88px;
        line-height: 36px;
        vertical-align: middle;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-grid-row-align: center;
        align-items: center;
        text-align: center;
        border-radius: 3px;
        box-sizing: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 0;
        padding: 0 6px;
        margin: 6px 8px;
        background: transparent;
        color: currentColor;
        white-space: nowrap;
        text-transform: uppercase;
        font-weight: 500;
        font-size: 14px;
        font-style: inherit;
        font-variant: inherit;
        font-family: inherit;
        text-decoration: none;
        overflow: hidden;
        -webkit-transition: box-shadow .4s cubic-bezier(.25,.8,.25,1),background-color .4s cubic-bezier(.25,.8,.25,1);
        transition: box-shadow .4s cubic-bezier(.25,.8,.25,1),background-color .4s cubic-bezier(.25,.8,.25,1);
    }
    .modal-btn-close:hover {
        background-color: rgba(158,158,158,0.2);
        color: rgb(63,81,181);
    }
    .tr_click {
        cursor: pointer;
    }
</style>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.tr_click').click(function(){
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/employee/customersupport/getViolatorphrasebyid/'+id,
                    dataType: 'JSON',
                    success: function(json) {
                        console.log(json)
                        $('input[name="template_id"]').val(id);
                        $('input[name="edit_type"]').val('1');
                        $('input[name="item_name"]').val(json.item_name);
                        $('input[name="title"]').val(json.title);
                        $('textarea[name="text"]').val(json.text);
                        if(json.complete == 1){
                            $('#op2').prop("checked", true);
                        }else{
                           $('#op1').prop("checked", true);  
                        }
                    }
                });
            }) 
        })
       function resetForm(){
            $('input[name="item_name"]').val('');
            $('input[name="title"]').val('');
            $('textarea[name="text"]').val('');
            $('#op2').prop("checked", true);
            return false;
        }
        function check_field1(){
            if($('textarea[name="text"]').val() == ''){
                $("#note-field").text('本文');
                $('#myModal').modal("show");
                return false
            }
            else if($('input[name="item_name"]').val() == ''){
                $("#note-field").text('項目名');
                $('#myModal').modal("show");
                return false
            }else if($('input[name="title"]').val() == ''){
                $("#note-field").text('件名');
                $('#myModal').modal("show");
                return false
            }else{
                return true;
            }
        }

        function check_del(){
            var len = $('input[name="yes[]"]:checked').length;
            if(len){
                return true;
            }else{
                return false;
            }
        }
        $('.modal-btn-close').click( function(){
            $('#myModal').modal("hide");
        });
    </script>
@endsection