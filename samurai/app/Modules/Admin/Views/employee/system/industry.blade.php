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
	                                <li class="active"><a href="{{URL::to('/admin/employee/system/industry')}}">業種</a></li>
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
                            <div class="blueheading"><span>項目設定管理</span></div>

                            <div id="content-nav">
                                <div class="horizontal-menu navbar-collapse collapse ">
                                    <ul class="nav navbar-nav">
                                        <li><a style="width: 200px" class="active" href="{{URL::to('/admin/employee/system/industry')}}">業種</a></li>
                                        <li><a style="width: 200px" href="{{URL::to('/admin/employee/system/tag')}}">タグ</a></li>
                                        <li><a style="width: 200px" href="{{URL::to('/admin/employee/system/category')}}">カテゴリー</a></li>
                                        <li><a style="width: 200px" href="{{URL::to('/admin/employee/system/question')}}">企業情報質問内容</a></li>
                                    </ul>

                                </div>
                            </div>

                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">登録した業種</legend>

                                <div class="control-group" style="margin-bottom:20px;">
                                    {{ Form::open(['url' => '/admin/employee/system/industry', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                    <div class="controls">
                                        <div class="col-sm-7" style="padding-left: 0px;">
                                            <div class="col-sm-7" style="margin-top: 2px; padding-left: 0px;">
                                                <p class="col-sm-3" style="padding-left: 0px;">業種:</p>
                                                {{Form::text('trade', '', ['class'=> 'col-sm-9'])}}
                                                {{Form::hidden('id', '')}}
                                            </div>
                                            <div class="col-sm-5" style="margin-top: 2px; margin-left: -30px;">
                                                <p class="col-sm-6">並び順:</p>
                                                {{Form::number('order', '1', ['class'=> 'col-sm-6', 'style'=>'margin-left: -20px'])}}
                                            </div>
                                        </div>
                                        {{Form::submit('新規登録', ['class'=>'submit-blue-left', 'id'=>'checksubmit', 'style'=>'width:100px'])}}

                                        <button type="reset" class="submit-blue-left" style="width:100px; margin-left:30px;" onclick="rssubmit()">クリアー</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                                {{ Form::open(['url' => '/admin/employee/system/industrystatus', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                <div class="control-group" style="margin-bottom:20px;">
                                    <div class="controls">
                                        <div class="col-sm-4" style="padding-left: 0px;">
                                            <div class="angularsl changsl">
                                                {{Form::select('status', ['0'=>'削除', '1'=>'表示', '2'=>'非表示'], 2)}}
                                            </div>
                                        </div>
                                        {{Form::submit('適用', ['class'=>'submit-blue-left'])}}
                                    </div>
                                </div>

                                <table class="table table-bordered" style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th width="6%" style="text-align:center;">選択
                                               {{--  {{Form::checkbox('checkall', '', false, ['class'=>'checkall'])}} --}}
                                            </th>
                                            <th width="16%" style="text-align:center;">並び順</th>
                                            <th style="text-align:center;">業種</th>
                                            <th width="20%" style="text-align:center;">表示</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($result))
                                            @foreach($result as $index => $val)
                                            <tr id="tr_{{$val->id}}" class="edittr">
                                                <td>{{Form::checkbox('display[]', $val->id , false, ['class'=>'check'])}}</td>
                                                <td onclick="editindustrycontent('{{$val->id}}','{{$val->trade}}','{{$val->order}}')">{{$index+1}}</td>
                                                <td onclick="editindustrycontent('{{$val->id}}','{{$val->trade}}','{{$val->order}}')">{{$val->trade}}</td>
                                                <td onclick="editindustrycontent('{{$val->id}}','{{$val->trade}}','{{$val->order}}')">{{$val->display}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{ Form::close() }}
                            </fieldset> 
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
            function editindustrycontent(id, trade, order) {
                $('input[name="trade"]').val(trade);
                $('input[name="order"]').val(order);
                $('input[name="id"]').val(id);
                $('#checksubmit').val('変更する');  
                $('.edittr').removeClass('outline');  
                $('#tr_'+id).addClass('outline'); 
            }
            function rssubmit() {
                $('#checksubmit').val('新規登録');
                $('input[name="id"]').val(''); 
                $('.edittr').removeClass('outline');  
            }
            
            $(document).on('click','.checkall', function(){
                var obj = $(this).val();
                if($('input.checkall:checked').length) {
                    $.each($("input.check"), function(){            
                        $(this).prop('checked', true);
                    });
                }else{
                    $.each($("input.check"), function(){            
                        $(this).prop('checked', false);
                    });
                }
            });
            $(document).on('click','#checksubmit', function(){
                if(!$('input[name="trade"]').val()) {
                    alert("すべての項目を正確に入力してください");
                    return false;
                }
            });
    </script>
@endsection