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
	                                <li class="active"><a href="{{URL::to('/admin/employee/system/alim')}}">お知らせ</a></li>
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
                            <div class="blueheading"><span>お知らせ</span></div>
                            <div class="section-3 col-md-12">
                                <h4 style="background-color:#F4F4F4;margin-left:10px;">お知らせ詳細</h4>
                                <div class="section3-full">
                                    <div class="section3-full-scroll">
                                        <div class="row" style="margin-bottom:20px;">
                                            <div class="col-sm-12">
                                                <ul class="nav nav-tabs tab-15" role="tablist">
                                                    <li role="presentation" class="tab-style-grey active" style="border-left: 0px;">
                                                        <a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">編集</a>
                                                    </li>
                                                    <li id="preview" role="presentation" style="border-left: 0px;">
                                                        <a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">プレビュー</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            {{ Form::open(['url' => '/admin/employee/system/alimadd', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                            <div class="tab-content" style="border:1px solid #000;">
                                                <div class="col-sm-12 tab-pane active" id="tab1">
                                                    <div class="col-sm-12" style="padding-top:10px;">
                                                        <div class="col-sm-3" style="text-align:center;">
                                                            <p style="padding-top:8px;"><b>設定日</b></p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="datepicker" id="datepicker1"  data-date="{{request()->created_date}}"></div> 
                                                            {{Form::hidden('created_date', request()->created_date, ['id'=>'showdayinput'])}}
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12" style="padding-top:10px;margin-bottom: 15px">
                                                        <div class="input-group" style="width: 100%;">
                                                            {{Form::text('title', request()->title, ["class"=>'form-control', 'placeholder'=>'タイトル', 'style'=>'width:92%'])}}
                                                            <div class="input-group-btn">
                                                                <label for="file" class="btn btn-primary">
                                                                    画像を追加
                                                                </label>
                                                                <input id="file" type="file" style="display: none;" accept="image/*" name="file"/>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                    <div class="col-sm-12" style="padding-top:10px;margin-bottom: 15px">
                                                        <div class="input-group" style="width: 100%;">
                                                            {{Form::textarea('content', request()->content, ['class'=>'tiny-textarea', 'id'=>'area1', 'col'=>'1000'])}}
                                                        </div>    
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 tab-pane" id="tab2">
                                                    <div style="margin-top: 20px;margin-bottom:20px;" class="col-sm-3">
                                                        {{HTML::image('assets/common/images/img-icon.png', '', ['style'=>'width: 100%', 'id'=>'imagerv'])}}
                                                    </div>
                                                    <div style="margin-top: 20px;margin-bottom:20px;" class="col-sm-9">
                                                        <p style="color:#147EC6;font-size:24px;padding-top:10px;">タイトル : <span id="titlerv"></span></p>
                                                        <div id="contentrv"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" style="padding-top:20px;padding-left:15px;">
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-2">
                                                {{Form::submit('公開して保存', ['class'=>'submit-blue-btn checksubmit', 'name'=>'type1'])}}
                                                </div>
                                                <div class="col-sm-2">
                                                {{Form::submit('公開せずに保存', ['class'=>'submit-white-btn checksubmit', 'style'=>'margin-left:20px;', 'name'=>'type0'])}}
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
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).on('click', '#preview', function(){
            $('#contentrv').html(tinyMCE.editors[$('#area1').attr('id')].getContent());
            $('#titlerv').html($('input[name="title"]').val());
            readURL(this, 'imagerv');
        });
        $("#file").change(function() {
            if(this.files[0].size > 8388608) {
                $(this).val('');
                alert("アップロードするファイルサイズが大きいです。");
            }else{
                readURL(this, 'imagerv');
            }
            
        });
        $('#datepicker1').datepicker({
            language : 'ja',
            inline: true,
            sideBySide: true,
            todayHighlight: true,
            format: "yyyy-mm-dd",
        }).on('changeDate', function(){
            var value = $('#datepicker1').datepicker('getFormattedDate');
            $('#showdayinput').val(value);
        });

        $(document).on('click', '.checksubmit', function(){
            if(!$('input[name="title"]').val()) {
                alert("すべての項目を正確に入力してください!");
                return false;
            }
            if(!tinyMCE.editors[$('#area1').attr('id')].getContent()) {
                alert("すべての項目を正確に入力してください!");
                return false;
            }
        });
    </script>
@endsection