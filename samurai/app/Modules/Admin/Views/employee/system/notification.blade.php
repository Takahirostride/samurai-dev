@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">施策データ管理</a><span>&gt;</span></li>
        <li><a>システム管理</a></li>
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
	                                <!-- <li><a href="{{URL::to('/admin/employee/system/advertisement')}}">広告表示管理</a></li> -->
	                                <li><a href="{{URL::to('/admin/employee/system/uservoice')}}">利用者の声</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/alim')}}">お知らせ</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/suggest')}}">おススメの助成金</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/industry')}}">業種</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/tag')}}">タグ管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/category')}}">カテゴリー管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/question')}}">企業情報質問内容管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/payinfo')}}">有料情報管理</a></li>
	                                <li class="active"><a href="{{URL::to('/admin/employee/system/notification')}}">通知管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/blog')}}">ブログ管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>通知設定管理</span></div>

                            <div class="section-3 col-md-12" style="padding-left:0px;">
                                <div class="section3-full" style="padding-left:0px;">
                                    <div class="section3-full-scroll" style="padding-left:8px;">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="angularsl" id="option">
                                                    <select name="keyword">
                                                        <option value="すべて">すべて</option>
                                                        @if($keywords)
                                                        @foreach ($keywords as $value)
                                                            <option value="{{$value->title}}" @if($value->title == $checked ) {{'selected='}} @endif >{{$value->title}}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="section-6 col-md-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="width:30%">項目名</th>
                                            <th>件名</th>
                                            <th style="width:40%">本文</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result as $key => $value)
                                        <tr class="tr_click @if($key%2 == 0)bg_white @endif" id="{{ $value->id }}"  role="button" tabindex="0" style="">
                                            <td></td>
                                            <td>{{$value->item_name}}</td>
                                            <td>{{$value->title}}</td>
                                            <td>{{$value->text}}</td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                {!! $result->links() !!}
                            </div>
                            <div class="col-md-12" style="background:#e0dec8;height:18px;margin-top:20px;"></div>
                            {{ Form::open(array('url' => '/admin/employee/system/updatenotification', 'method' =>'POST')) }}
                            <div class="col-md-12" style="padding-left:50px;padding-right:50px;margin-top:30px;">
                                <div class="add-container" style "margin-left:0px;margin-right:0px;"="">

                                    <div class="row">
                                        <div class="col-md-3" style="background:#fff;">
                                            <div class="gridcell-left">
                                                <p style="font-size:14px;">項目名</p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="gridcell-right" style="height:40px;">
                                                {{Form::text('item_name','', array("class" => "form-control","name" =>"item_name"))}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3" style="background:#fff;">
                                            <div class="gridcell-left">
                                                <p style="font-size:14px;">送信対象</p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="gridcell-right" style="height:40px;">
                                                <div class="col-md-8" style="padding-left:0px;">
                                                    <div class="angularsl" id="sender_id">
                                                        {{Form::select('sender_id', array('1' => '選択', '2' => '事業者','3'=>'士業', 4=>'すべて'))}} 
                                                    </div>
                                                </div>
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
                                        <div class="col-md-3" style="background:#fff;">
                                            <div class="gridcell-left">
                                                <p style="font-size:14px;">送信元</p>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="gridcell-right" style="height:40px;">
                                                <div class="col-md-8" style="padding-left:0px;">
                                                    <div class="angularsl" id="sender_mail">
                                                        {{Form::select('sender_mail', array('1' => '選択', 'info@samurai-match.jp' => 'info@samurai-match.jp'))}} 
                                                    </div>
                                                </div>
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
                                                {{Form::hidden('id')}}
                                                {{Form::hidden('edit_type',0)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top:50px; margin-bottom: 30px">
                                    {{Form::submit('保存する', array("class"=>"submit-blue-btn", 'value'=>'保存する', 'name'=>'submit1','onclick'=>'return check_field1()'))}}
                                    
                                </div>
                            </div>
                            {{ Form::close() }}
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
    .bg_white td{
        background: #fff;
    }
</style>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '#option .showoption div', function(){
            var parent_id = $(this).parent().parent().attr('id');
            var status_id = $('#'+parent_id).find('select').val();
            console.log(status_id);
            var url = '/admin/employee/system/notification/';
            if(status_id == 'すべて'){
                window.location=url;
            }else{
                window.location=url+status_id;
            }                
            })
        $('.tr_click').click(function(){
            var id = $(this).attr('id');
            console.log(id);
            $.ajax({
                url: '/admin/employee/system/notificationbyid/'+id,
                dataType: 'JSON',
                success: function(json) {
                    console.log(json)
                    $('input[name="id"]').val(id);
                    $('#sender_id select').val(json.to_id);
                    $('#sender_mail select').val(json.source);
                    $('input[name="edit_type"]').val('1');
                    $('input[name="item_name"]').val(json.item_name);
                    $('input[name="item_name"]').prop('disabled', true);
                    $('input[name="title"]').val(json.title);
                    $('textarea[name="text"]').val(json.text);
                    setupselect();
                }
            });
        })        
     
    })
     
    function check_field1(){
        if($('textarea[name="text"]').val() != '' && $('input[name="item_name"]').val() != '' 
              && $('input[name="title"]').val() != '' ){
            return true;
        }else{
            alert('コメントを正確に入力してください');
            return false;
        }
    }
    </script>
@endsection