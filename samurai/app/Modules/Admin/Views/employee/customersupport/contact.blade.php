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
	                                <li class="active"><a href="{{('/admin/employee/customersupport/contact')}}">お問い合わせ対応設定</a></li>
	                                <li><a href="{{('/admin/employee/customersupport/identifydoc')}}">本人確認書類管理</a></li>
	                                <!-- <li><a href="{{('/admin/employee/customersupport/identifyphrase')}}">本人確認書類対応設定</a></li> -->
	                                <li><a href="{{('/admin/employee/customersupport/violator')}}">違反者管理</a></li>
	                                <!-- <li><a href="{{('/admin/employee/customersupport/violatorphrase')}}">違反者対応設定</a></li> -->
	                                
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>お問い合わせ定型文管理</span></div>
                            {{ Form::open(array('url' => 'admin/employee/customersupport/delContact', 'method' =>'POST')) }}
                            <div class="row" style="margin-left:0px;margin-right:0px;">
                                <div class="section-5 col-md-12" style="display:block;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>選択</th>
                                                <th style="min-width:100px;">項目名</th>
                                                <th style="min-width:150px;">件名</th>
                                                <th style="max-width:300px;">本文</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result as $value)
    											<tr class="tr_click" id="{{ $value->id }}">
    												<td role="button" tabindex="0"><input type="checkbox" name="yes[]" value="{{ $value->id }}" ></td>
    												<td style="min-width:100px;" >{{ $value->item_name }}</td>
    												<td style="min-width:150px;" >{{ $value->title }}</td>
    												<td style="min-width:150px;" >{{ $value->text }}</td>
    											</tr>
                                            @endforeach
										</tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row" style="margin-left:0px;margin-right:0px;">
                                <div class="col-md-2">
                                    <input type="submit" style="margin-top:15px;position:absolute;top:23px;z-index: 1;" name="submit" class="submit-blue-btn" onclick="return check_del();" value="削除する">
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
                                {{ Form::open(array('url' => 'admin/employee/customersupport/updateContact', 'method' =>'POST')) }}
                                <input type="submit" name="reset" onclick="return resetForm();" style="position:initial;margin-left:0px;" class="submit-blue-btn" value="新規登録" >
                                <div class="add-container" style "margin-left:0px;margin-right:0px;"="">

                                    <div class="row">
                                        <div class="col-md-3" style="background:#fff;">
                                            <div class="gridcell-left">
                                                <p style="font-size:14px;">項目名</p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="gridcell-right">
                                                <input class="form-control" type="text" name="item_name" >
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
                                                <input class="form-control" type="text" name="title">
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
                                                <textarea name="text" class="form-control" style="width:100%;" rows="5" ></textarea>
                                                {{Form::hidden('edit_type')}}
                                                {{Form::hidden('template_id')}}

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top:50px;">
                                    <input type="submit" name="submit" class="submit-blue-btn" onclick="return check_field1();" value="登録する" >
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
    
</style>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.tr_click').click(function(){
                var id = $(this).attr('id');
                $.ajax({
                    url: '/admin/employee/customersupport/getContactbyid/'+id,
                    dataType: 'JSON',
                    success: function(json) {
                        console.log(json)
                        $('input[name="template_id"]').val(id);
                        $('input[name="edit_type"]').val('1');
                        $('input[name="item_name"]').val(json.item_name);
                        $('input[name="title"]').val(json.title);
                        $('textarea[name="text"]').val(json.text);
                    }
                });
            }) 
        })
       function resetForm(){
            $('input[name="item_name"]').val('');
            $('input[name="title"]').val('');
            $('textarea[name="text"]').val('');
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