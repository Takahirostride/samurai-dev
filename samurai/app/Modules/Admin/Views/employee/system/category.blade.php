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
	                                <li class="active"><a href="{{URL::to('/admin/employee/system/category')}}">カテゴリー管理</a></li>
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
                                        <li><a style="width: 200px" href="{{URL::to('/admin/employee/system/industry')}}">業種</a></li>
                                        <li><a style="width: 200px" href="{{URL::to('/admin/employee/system/tag')}}">タグ</a></li>
                                        <li><a style="width: 200px" class="active" href="{{URL::to('/admin/employee/system/category')}}">カテゴリー</a></li>
                                        <li><a style="width: 200px" href="{{URL::to('/admin/employee/system/question')}}">企業情報質問内容</a></li>
                                    </ul>

                                </div>
                            </div>

                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">設定したカテゴリー</legend>

                                <div class="control-group" style="margin-bottom:20px;">
                                    {{ Form::open(['url' => '/admin/employee/system/category', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                    <div class="controls">
                                        <div class="col-sm-6">
                                            @php
                                            if(request()->subid) $showtext = $category->category_name;
                                            else $showtext = '';
                                            @endphp
                                            {{Form::text('category', $showtext, ['class'=> 'form-control'])}}
                                                {{Form::hidden('id', request()->subid)}}
                                        </div>
                                        {{Form::submit('新規登録', ['class'=>'submit-blue-left', 'id'=>'checksubmit', 'style'=>'width:100px'])}}
                                        <button type="reset" class="submit-blue-left" style="width:100px; margin-left:30px;"  onclick="rssubmit()">クリアー</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                                {{ Form::open(['url' => '/admin/employee/system/categorystatus', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                <div class="control-group" style="margin-bottom:20px;">
                                    <div class="controls">
                                        <div class="col-sm-4">
                                            <div class="angularsl">
                                                {{Form::select('status', ['0'=>'削除', '1'=>'表示', '2'=>'非表示'], 2)}}
                                            </div>
                                        </div>
                                        {{Form::submit('適用', ['class'=>'submit-blue-left'])}}
                                    </div>
                                </div>

                                <table class="table table-bordered" style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th width="10%" style="text-align:center;">選択
                                                {{--  {{Form::checkbox('checkall', '', false, ['class'=>'checkall'])}} --}}
                                            </th>
                                            <th width="16%" style="text-align:center;">並び順</th>
                                            <th style="text-align:center;">カテゴリー</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($categorys))
                                            @foreach($categorys as $index => $val)
                                            <tr id="tr_{{$val->id}}" class="edittr">
                                                <td>
                                                    {{Form::checkbox('ids[]', $val->id , false, ['class'=>'check'])}}
                                                </td>
                                                <td onclick="editcategorycontent('{{$val->id}}')">{{$index+1}}</td>
                                                <td onclick="editcategorycontent('{{$val->id}}')">{{$val->category_name}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{ Form::close() }}
                            </fieldset>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">設定したカテゴリー詳細</legend>

                                <div class="control-group" style="margin-bottom:20px;">
                                    <div class="controls">
                                        <div class="col-sm-12" style="margin-bottom:20px;">
                                            <label class="ng-binding">選択しているカテゴリー：{{$category->category_name}}</label>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::open(['url' => '/admin/employee/system/subcategory', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                <div class="control-group" style="margin-bottom:20px;">
                                    <div class="controls">
                                        <div class="col-sm-6">
                                            @php
                                            if(!request()->subid) $subid = $category->id;
                                            else $subid = request()->subid;
                                            @endphp
                                            {{Form::text('subcategory', request()->subcategory, ['class'=> 'form-control'])}}
                                            {{Form::hidden('subid', $subid)}}
                                            {{Form::hidden('id', request()->id)}}
                                            {{Form::text('subcategoryvalue', request()->subcategoryvalue, ['class'=> 'form-control'])}}
                                        </div>
                                        <div class="col-sm-6">
                                            {{Form::submit('新規登録', ['class'=>'submit-blue-left', 'id'=>'checksubmitsub', 'style'=>'width:100px'])}}
                                            
                                            <button type="reset" class="submit-blue-left" onclick="rssubsubmit()" style="width:100px; margin-left:30px;">クリアー</button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                                <div class="clearfix"></div>
                                 {{ Form::open(['url' => '/admin/employee/system/subcategorystatus', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                
                                <div class="control-group" style="margin-bottom:20px;">
                                    <div class="controls">
                                        <div class="col-sm-4">
                                            <div class="angularsl">
                                                {{Form::select('status', ['0'=>'削除', '1'=>'表示', '2'=>'非表示'], 2)}}
                                                {{Form::hidden('subid', $subid)}}
                                            </div>
                                        </div>
                                        {{Form::submit('適用', ['class'=>'submit-blue-left'])}}
                                    </div>
                                </div>

                                <table class="table table-bordered" style="text-align:center;">
                                    <thead>
                                        <tr>
                                            <th width="10%" style="text-align:center;">選択
                                                {{--  {{Form::checkbox('checkall', '', false, ['class'=>'checkall'])}} --}}
                                            </th>
                                            <th width="16%" style="text-align:center;">並び順</th>
                                            <th style="text-align:center;">カテゴリー</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($smallCategory))
                                            @foreach($smallCategory as $index => $val)
                                            <tr id="tr_{{$val->id}}" class="edittr">
                                                <td>
                                                    {{Form::checkbox('ids[]', $val->id , false, ['class'=>'check'])}}
                                                </td>
                                                <td onclick="editsubcategorycontent('{{$val->id}}','{{$val->sub_name}}')">{{$index+1}}</td>
                                                <td onclick="editsubcategorycontent('{{$val->id}}','{{$val->sub_name}}')">{{$val->sub_name}}</td>
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
            function editcategorycontent(id) {
                window.location.href = "{{URL::to('/admin/employee/system/category/')}}/"+id;
            }
            function rssubmit(id, category, order) {
                window.location.href = "{{URL::to('/admin/employee/system/category/')}}";  
            }

            function editsubcategorycontent(id, subcategory) {
                $('input[name="subcategory"]').val(subcategory);
                $('input[name="id"]').val(id);
                $('#checksubmitsub').val('変更する');  
                $('.edittr').removeClass('outline');  
                $('#tr_'+id).addClass('outline'); 
            }
            function rssubsubmit() {
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
                if(!$('input[name="category"]').val()) {
                    alert("すべての項目を正確に入力してください");
                    return false;
                }
            });
            $(document).on('click','#checksubmitsub', function(){
                if(!$('input[name="subcategory"]').val()) {
                    alert("すべての項目を正確に入力してください");
                    return false;
                }
            });
    </script>
@endsection