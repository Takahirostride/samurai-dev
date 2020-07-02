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
	                                <li><a href="{{('/admin/employee/customersupport/identifyphrase')}}">本人確認書類対応設定</a></li>
	                                <li><a href="{{('/admin/employee/customersupport/violator')}}">違反者管理</a></li>
	                                <li><a href="{{('/admin/employee/customersupport/violatorphrase')}}">違反者対応設定</a></li>
	                                <li class="active"><a href="{{('/admin/employee/customersupport/manageadvertise')}}">広告掲載管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="site-content" >
                        <div class="row" style="margin-top: 20px;  padding-left: 40px; padding-right: 40px; ">
                            <div class="col-sm-12" style="text-align:center;padding-bottom:20px;padding-top:20px;">
                                @if($result[0]->image_url != '')
                                <img src="{{$result[0]->image_url}}" style="width: 245px;height:245px;"  />
                                @else
                                <img src="./assets/img/img-icon.png" style="width: 270px;height:270px;" />
                                @endif
                            </div>
                            <table class="table table-bordered" style="padding-top: 50px; border: 1px solid #d6d6d6;">
                                <tbody>
                                <tr>
                                    <td class="td-div-blue"><h5>タイトル</h5> </td>
                                    <td style="font-size: 12px"><label ng-bind="adver_detail.title"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-div-blue"><h5>内容</h5> </td>
                                    <td style="font-size: 12px">{{$result[0]->title}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-div-blue"><h5>URL</h5> </td>
                                    <td style="font-size: 12px">{{$result[0]->url}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-div-blue"><h5>料金</h5></td>
                                    <td style="font-size: 12px">{{$result[0]->charge}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="blueheading col-sm-10"><span>販売者情報</span></div>
                        <div class="row" style="display:block;margin-top:50px; padding-left: 40px; padding-right: 40px;">
                            <div class="col-sm-3">
                                <div  style="text-align:center;padding:20px;border:1px solid #503737; width:240px;height:240px;">
                                    @if($result[0]->image != '')
                                    <img src="{{$result[0]->image}}" style="width: 200px;height:200px;" />
                                    @else
                                    <img src="./resources/img/clienticon.png" style="width: 200px;height:200px;" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <table class="table table-bordered" style="padding-top: 50px; border:0px;">
                                    <tbody>
                                    <tr>
                                        <td class="td-div-blue"><h5>事業所名</h5> </td>
                                        <td style="font-size: 12px">{{$result[0]->company_name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-div-blue"><h5>所在地</h5> </td>
                                        <td style="font-size: 12px">{{$result[0]->location.$result[0]->municipality}}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-div-blue"><h5>電話番号</h5> </td>
                                        <td style="font-size: 12px">{{$result[0]->phone_number}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="td-div-blue"><h5>自己紹介</h5> </td>
                                        <td style="font-size: 12px">{{$result[0]->self_intro}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="blueheading col-sm-10"><span>メッセージを入力する</span></div>
                        <div class="row" style="margin-top:50px; padding-left: 20px; padding-right: 20px;">
                            {{ Form::open(array('url' => 'admin/employee/customersupport/send_message', 'method' =>'POST','id'=>'form','enctype'=>'multipart/form-data')) }}
                            <table class="table table-hover table-bordered" style="border: 1px solid #d6d6d6; margin:auto;width:70%">
                                <tbody>
                                <tr>
                                    <td rowspan="3" class="div-style-blue2 text-primary" style="font-size: 12px;width: 20%">
                                    </td>
                                    <td style="font-size: 12px">
                                        <div style="height:150px;overflow-y:auto;overflow-x:hidden;border: 1px solid #bebebe;" scroll="messagedetail">
                                            <table class="table table-bordered" style="margin-bottom:0px;border-bottom:0px;">
                                                <tbody>
                                                @foreach ($result2 as $value)
                                                <tr>
                                                    <td style="border:0px; padding-left:20px;padding-right:20px;">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <hr>
                                                            </div>
                                                            <h5 class="text-center col-sm-3"><b>
                                                                {{ date('Y年m月d日', strtotime($value->update_date)) }}</b></h5>
                                                            <div class="col-sm-5">
                                                                <hr>
                                                            </div>
                                                        </div>
                                                        <h5>{{getmessagesendername($value->from_id,$value->displayname)}} :</h5>
                                                        <p>{{$value->message}}</p>
                                                        <div>
                                                            @if($value->file !='')
                                                            @php ($arr_file =  json_decode($value->file, true))
                                                            
                                                            @foreach ($arr_file as $value1)
                                                            <p><a onclick="return downloaddocfile('{{$value1[1]}}','{{$value1[0]}}')" >{{$value1[0]}}</a></p>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <table class="table table-bordered" style="margin-bottom: 0px">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <hr>
                                                        </div>
                                                        <h5 class="text-center col-sm-3"><b>{{ date('Y年m月d日', strtotime(date("Y-m-d"))) }}</b></h5>
                                                        <div class="col-sm-5">
                                                            <hr>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label" for="formInput362" style="font-size: 12px;width:100%;margin-bottom:0px;border: 1px solid #bebebe;padding:7px 3px 0px 7px;">
                                                            <img src="../../../../assets/common/images/messagesend.png" style="margin-right:10px;"><text>{{$result[0]->self_intro}}</text>
                                                            <label for="file" style="float:right;font-size:16px;margin-right:15px;" id="get_file">
                                                                <span class="glyphicon glyphicon-paperclip"  ></span>
                                                            </label>
                                                            <input id="file" name="file[]" onclick="return hide_tab_bottom()"  type="file" style="display: none;" onchange="return selectresumefile()" multiple="multiple"/>
                                                        </label>
                                                        <textarea class="form-control" style="border-radius:0px;" rows="6" id="message" name="message"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="row" style="margin-left: 0px;margin-right: 0px;">
                                            <ul class="nav nav-tabs tab-1">
                                                <li>
                                                    <a data-toggle="tab" onclick="hide_tab_bottom()"> <b> <u>添付ファイル</u></b></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div id="bottomtab">
                                            <div class="col-sm-12 div-addtional-file">
                                                <div class="col-sm-12 none-padding">
                                                    <div class="col-sm-8" style="padding-top:8px;">
                                                        <div class="col-sm-12" id="list_file" style="padding-top:0px;">
                                                            <!-- add file list upload -->
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 none-padding">
                                                        <div class="row" style="height:150px;width:100%;margin-left:0px;margin-right:0px;">
                                                            <div id="dropbox1" class="dropbox" style="text-align:center;border:0px;">
                                                                <img class="drop-image1" src="../../../../assets/common/images/fileupload.png">
                                                                <p class="drop-p1-1" >アップロードする場合は、</p>
                                                                <p class="drop-p2-1">ここにドラッグ＆ドロップしてください。</p>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 none-padding div-func-buttion">
                                                    <button type="button" class="btn btn-delete-red" style="width:110px;margin-left:20px;margin-top: 4px;" onclick="return deletefiles()">削除する</button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row text-center" style="margin-bottom:60px;">
                                <input type="submit" class="btn btn-style-shadow-green btn-success" style="width:150px;margin-top:50px;margin-bottom:20px;" value="送信する" onclick="return sendmessage()"/>
                            </div>
                            {{Form::hidden('from_id',$user_id)}}
                            {{Form::hidden('to_ids', json_encode($from_ids))}}
                            {{Form::hidden('type',2)}}
                            {{Form::hidden('policy_id',0)}}
                            {{Form::hidden('count_file','',array('id'=>"count_file"))}}
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
                    <p class="">アップロードできるファイルは５個までです。</p>
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
       class _DataTransfer {
          constructor() {
            return new ClipboardEvent("").clipboardData || new DataTransfer();
          }
        } 
       var selectedfilearray = new Array();
       var bottomtab = 1;
       listneradded=0;
       function deleteimagefile1(id){
            console.log(id);
           $('#image_name'+id).val('');
           $('#image_url'+id).attr( "src", "" );
       }
        
        function downloaddocfile(filepath,filename){
            window.open("/employee/customersupport/downloadfile/"+filepath+"/"+filename);
        }

        function selectresumefile() {
            var files = document.getElementById("file");
            var files = files.files;
            console.log(files);
            for(var i=0;i<files.length;i++){
                if(selectedfilearray.length<5){
                    selectedfilearray.push({name:files[i].name,file:files[i]});
                }
                else{
                     $('#myModal').modal("show");
                    return;
                }
            }
            showfileUload();
        };
    function showfileUload(){
        var html ="";
        //console.log(selectedfilearray);
        for (var i = 0; i <= selectedfilearray.length - 1; i++) {
           html +='<p><label><input class="control-label" type="checkbox" value="'+i+'" name="del_group[]" >'+selectedfilearray[i]['name']+'</label></p>';
        }
        $('#list_file').html(html);
    }
    // get file drag/drop
    var dropbox1 = document.getElementById("dropbox1");
    dropbox1.addEventListener("dragenter", dragEnterLeave, true);
    dropbox1.addEventListener("dragleave", dragEnterLeave, true);
    dropbox1.addEventListener("dragover", dragOver, true);
    dropbox1.addEventListener("drop", dropEvent, true);
    // init event handlers
    function dragEnterLeave(evt) {
        evt.stopPropagation();
        evt.preventDefault();
    }

    function dragOver(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        var clazz = 'not-available';
        var ok = evt.dataTransfer && evt.dataTransfer.types && evt.dataTransfer.types.indexOf('Files') >= 0;
        $('.dropbox').css('background-color', '#15b86c80');
    }

    function dropEvent(evt) {
        console.log('drop evt:', JSON.parse(JSON.stringify(evt.dataTransfer)))
        evt.stopPropagation();
        evt.preventDefault();
        $('.dropbox').css('background-color', '#fff');
        var files = evt.dataTransfer.files;
        
        //console.log(files);
        if (files.length > 0) {
            for(var i=0; i<files.length; i++){
                if(selectedfilearray.length<5){

                    if(files[i].size<8388608){
                        console.log('xxx');
                        selectedfilearray.push({name:files[i].name,file:files[i]});
                    }
                    else{
                        alert("アップロードするファイルサイズが大きいです。");
                    }

                }else{
                    $('#myModal').modal("show");
                    return;
                }
            }
            showfileUload();
        }
    }
    // end get file drag/drop
    function deletefiles() {

        ids = new Array();
        $('input[name="del_group[]"]:checked').each(function() {
           ids.push(this.value); 
           
        });
        if(ids.length >0){
            for(i=0; i<ids.length; i++){
                selectedfilearray.splice((ids[i]-i),1);
            }
            showfileUload();
        }
    };

    $('.modal-btn-close').click( function(){
        $('#myModal').modal("hide");
    });

    function hide_tab_bottom(){
        $('#bottomtab').hide();
    } 

    function sendmessage(){
        var input = $('#message');
        if(input.val()==""){
            alert("メッセージを入力してください。");
            return false;
        }
        let fd = new FormData($('form#form')[0]);
        var file_ar = $('#file');
        
        if(selectedfilearray.length > 0){
            for (var i = 0; i < selectedfilearray.length; i++) {
                fd.append("fileToUpload"+i, selectedfilearray[i].file);
            }
             fd.append("count_file", selectedfilearray.length);
        }
        $.ajax({
            url: '/admin/employee/customersupport/send_message',
            type: 'POST',
            data: fd,
            async: false,
            success: function (data) {
                console.log(data);
                location.reload();
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false; 
    }
    </script>
@endsection