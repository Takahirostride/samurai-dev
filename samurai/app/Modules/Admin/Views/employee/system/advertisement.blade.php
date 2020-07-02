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
    <div class="content">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <ul>
	                                <!-- <li class="active"><a href="{{URL::to('/admin/employee/system/advertisement')}}">広告表示管理</a></li> -->
	                                <li><a href="{{URL::to('/admin/employee/system/uservoice')}}">利用者の声</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/alim')}}">お知らせ</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/suggest')}}">おススメの助成金</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/industry')}}">業種</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/tag')}}">タグ管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/category')}}">カテゴリー管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/question')}}">企業情報質問内容管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/payinfo')}}">有料情報管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/notification')}}">通知管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/blog')}}">ブログ管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>広告管理</span></div>
                            <div class="section-3 col-md-12" style="padding-left:0px;">
                                <div class="section3-full" style="padding-left:0px;">
                                    <div class="section3-full-scroll" style="padding-left:8px;">
                                        <div class="row">
                                            <div class="col-sm-3">
                                            	<div class="angularsl">
                                                    <select name="location"> 
                                                        <option value="1">トップ広告</option>
                                                        <option value="2">トップ広告fsa</option>
                                                    </select>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::open(['url' => '/admin/employee/system/advertisement', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                            <div class="section-3 col-md-12">
                                <h4 style="background-color:#F4F4F4;margin-left:10px;">トップ広告</h4>
                                <div class="section3-full">
                                    <div class="section3-full-scroll">
                                        <input type="hidden" name="total" value="{{count($result)}}">
                                        @if (!empty($result))
                                            @foreach($result as $i => $val)
                                        <!-- ngRepeat: advertitem in advertdata -->
                                        <div class="row" style="margin-bottom: 20px;">
                                            <p class="col-sm-1 ng-binding" style="padding-left:0px;padding-right:0px;">広告{{$i+1}}</p>
                                            <div class="col-sm-11 checkempty">
                                                <div class="row" style="margin-bottom:10px;">
                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">表示画像</p>
                                                    <div class="col-sm-10">
                                                        <div class="input-group">
                                                            <div class="has-feedback" style="margin-bottom:0px;">
                                                                {{Form::text('image_name['.$val->id.']', $val->image_name, ['class'=>'form-control imagename', 'readonly'=>'readonly', 'placeholder'=>'表示画像', 'id'=>'image_name'.$val->id])}}
                                                                <span class="form-control-feedback clear_file" style="pointer-events: auto;"><i class="fa fa-close" style="padding-top:7px;"></i></span>
                                                            </div>
                                                            <div class="input-group-btn">
                                                                <label for="file{{$val->id}}" class="submit-blue-left" style="font-size:18px;text-align:center;padding-top:2px;">参照</label>
                                                                <input id="file{{$val->id}}" type="file" name="imagefile{{$val->id}}" class="hidefile" data-showname="image_name{{$val->id}}" style="display: none;" accept="image/*"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">URL</p>
                                                    <div class="col-sm-10">
                                                        {{Form::text('url['.$val->id.']', $val->url, ['class'=>'form-control url','id'=>'url'.$val->id, 'placeholder'=>'URL'])}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end ngRepeat: advertitem in advertdata -->
                                        @endforeach
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div style="margin-top:50px;">
                                {{Form::submit('保存する', ['class'=>'submit-blue-btn', 'id'=>'checksubmit'])}}
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

@section('script')
    <script>
        $(document).ready(function(){
            $.each($(".input-group"), function(){            
                var obj = $(this);
                if(obj.find('.imagename').val()) {
                    obj.find('.clear_file').show();
                }
            });
        });
        $(document).on('change', '.hidefile', function(){
            var obj = $(this);
            if(this.files[0].size > 8388608) {
                obj.closest('.input-group').find('input').val('');
                alert("file size is too big");
            }else{
                obj.closest('.input-group').find('.clear_file').show();
            }
        });
        $(document).on('click', '.clear_file', function(){
            var obj = $(this);
            obj.hide();
            obj.closest('.input-group').find('input').val('');
        });

        $('#checksubmit').on('click', function () {
            for (var i = 1; i <= $(".checkempty").length; i++) {
                var image_name = $("#image_name"+i).val();
                var url = $("#url"+i).val();
                if(image_name == "" && url!="") {
                    dialog('<b>ポップアップ</b>','<b>広告'+i+'</b>フィールドを正確に記入してください！', '確認');
                    return false;
                }
                if(image_name!="" && url=="") {
                    dialog('<b>ポップアップ</b>','<b>広告'+i+'</b>フィールドを正確に記入してください！', '確認');
                    return false;
                }
            }
        });
    </script>
@endsection