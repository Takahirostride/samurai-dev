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
	                                <li class="active"><a href="{{URL::to('/admin/employee/system/question')}}">企業情報質問内容管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/payinfo')}}">有料情報管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/notification')}}">通知管理</a></li>
	                                <li><a href="{{URL::to('/admin/employee/system/blog')}}">ブログ管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="blueheading"><span>項目設定管理</span></div>

                            <div id="content-nav">
                                <div class="horizontal-menu navbar-collapse collapse ">
                                    <ul class="nav navbar-nav">
                                        <li><a style="width: 200px" href="{{URl::to('/admin/employee/system/industry')}}">業種</a></li>
                                        <li><a style="width: 200px" href="{{URl::to('/admin/employee/system/tag')}}">タグ</a></li>
                                        <li><a style="width: 200px" href="{{URl::to('/admin/employee/system/category')}}">カテゴリー</a></li>
                                        <li><a style="width: 200px" class="active" href="{{URl::to('/admin/employee/system/question')}}">企業情報質問内容</a></li>
                                    </ul>

                                </div>
                            </div>
                            {{ Form::open(['url' => '/admin/employee/system/question', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">登録する企業情報質問内容</legend>
                                <div class="control-group" style="margin-bottom:20px;">
                                    <div class="controls">
                                        <div class="col-sm-12" style="margin-bottom:10px;">
                                            <label>質問を表示するカテゴリー</label>
                                        </div>
                                        <div class="col-sm-4" style="margin-bottom:20px;">
                                            <div class="angularsl">
                                                {{Form::select('category', $cate, @$sub->category_id)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group" style="margin-bottom:20px;">
                                    <div class="controls">
                                        <div class="col-sm-12" style="margin-bottom:10px;">
                                            <label>質問内容</label>
                                        </div>
                                        <div class="col-sm-10" style="margin-bottom:20px;">
                                            {{Form::text('question', @$sub->detail_question, ['class'=>'form-control'])}}
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group" style="margin-bottom:20px;">
                                    <div class="controls">
                                        <div class="col-sm-12" style="margin-bottom:40px;">
                                            <div id="subcatelist">
                                            @if (!empty($subcategorys))
                                                @foreach($subcategorys as $index => $val)
                                                <div class="col-sm-2" style="margin-bottom: 10px;">
                                                    <label>
                                                        <input name="subcategory" type="radio" value="{{$val->id}}" @if($val->id==@$sub->id) checked @endif >{{$val->sub_name}}
                                                    </label>
                                                </div>
                                                @endforeach
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group" style="margin-bottom:20px;">
                                    <div class="controls">
                                        <div class="col-sm-12" style="text-align:center;margin-bottom:20px;">
                                            {{Form::submit('新規登録', ['class'=>'submit-blue-left', 'id'=>'checksubmit', 'style'=>'width:100px;margin-right:30px;'])}}
                                            <button type="button" class="submit-blue-left" style="width:100px;" onclick="rssubmit()">クリアー</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            {{ Form::close() }}
                            {{ Form::open(['url' => '/admin/employee/system/questionstatus', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                            <fieldset class="scheduler-border">
                                <div class="control-group" style="margin-bottom:20px;margin-top:20px;">
                                    <div class="controls">
                                        <div class="col-sm-4">
                                            <div class="angularsl">
                                                {{Form::select('status', ['0'=>'削除', '1'=>'表示', '2'=>'非表示'], 2)}}
                                            </div>
                                        </div>
                                        {{Form::submit('適用', ['class'=>'submit-blue-left', 'style'=>'width:100px;'])}}
                                    </div>
                                </div>
                                @if (!empty($quests))
                                    @foreach($quests as $key => $quest)
                                    <div>
                                        <div class="col-sm-12" style="margin-bottom:10px;">
                                            <label style="font-size:20px;">{{$datashows[$key]}}:</label>
                                        </div>

                                        <table class="table table-bordered" style="text-align:center;">
                                            <thead>
                                                <tr>
                                                    <th width="10%" style="text-align:center;">選択
                                                        <!-- <input type="checkbox"> -->
                                                    </th>
                                                    <th width="16%" style="text-align:center;">並び順</th>
                                                    <th style="text-align:center;">質問内容</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (!empty($quests))
                                                    @foreach($quest as $index => $val)
                                                    <tr>
                                                        <td>
                                                            {{Form::checkbox('ids[]', $val->id , false, ['class'=>'check'])}}
                                                        </td>
                                                        <td onclick="linkto('{{$val->id}}')">{{$index+1}}</td>
                                                        <td onclick="linkto('{{$val->id}}')">{{$val->detail_question}}</td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    @endforeach
                                @endif
                            </fieldset>
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
            function linkto(id) {
                window.location.href = "{{URL::to('/admin/employee/system/question/')}}/"+id;
            }
            function rssubmit() {
                window.location.href = "{{URL::to('/admin/employee/system/question/')}}";  
            }

            
            $(document).on('click','#checksubmit', function(){
                // console.log($('input[name="subcategory"]:checked').val());
                if(!$('input[name="question"]').val()) {
                    alert("すべての項目を正確に入力してください");
                    return false;
                }
                if(!$('input[name="subcategory"]:checked').length) {
                    alert("すべての項目を正確に入力してください");
                    return false;
                }

            });

            $(document).on('change','select[name="category"]', function(){
                var url="{{URL::to('/admin/employee/system/ajax_get_sub_category/')}}"+"/"+$(this).val();
                $.get(url, function(data, status){
                    var ar = JSON.parse(data);
                    $('#subcatelist').html('');

                    for(key in ar){
                        var text = '<div class="col-sm-2" style="margin-bottom: 10px;"><label>\
                            <input name="subcategory" type="radio" value="'+key+'">'+ar[key]+'\
                        </label></div>';
                        $('#subcatelist').append(text);
                    }
                });
            });
    </script>
@endsection