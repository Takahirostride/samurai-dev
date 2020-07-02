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
	                                <li><a href="{{URL::to('/admin/employee/system/notification')}}">通知管理</a></li>
	                                <li class="active"><a href="{{URL::to('/admin/employee/system/blog')}}">ブログ管理</a></li>
	                            </ul>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="section-1">
                                <!-- ngIf: messageflag -->
                            </div>
                            <label style="font-size:22px;">ブログ公開管理</label>
                            <div style="border-bottom:1px solid #000000;margin-bottom:40px;"></div>
                            {{ Form::open(array('url' => 'admin/employee/system/blog', 'method' =>'GET')) }}
                            <div class="section-2 col-md-12">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-11">
                                        <div class="form-group" style="margin-top:30px;">
                                            <p class="col-sm-2">絞り込み検索</p>
                                            <div class="col-sm-4">
                                                {{Form::text('keyword','', array("class" => "form-control","name" =>"keyword","placeholder"=>"絞り込み検索"))}}
                                                {{Form::hidden('form_option')}}
                                            </div>
                                            <div class="col-sm-4">
                                                {{Form::submit('検索する', array("class"=>"submit-blue-btn", 'value'=>'検索する', 'name'=>'submit'))}}
                                            </div>
                                        </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                            {{ Form::open(array('url' => 'admin/employee/system/changeoptionblog', 'method' =>'POST')) }}
                            <div class="section-3 col-md-12">
                                <div class="section3-full">
                                    <div class="section3-full-scroll">
                                        <div class="row" style="margin-top:30px;">
                                            <div class="col-sm-3">
                                                <div class="angularsl" id="option">
                                                    {{Form::select('option', array('0' => 'すべて', '1' => '士業','2'=>'認定士業','3'=>'掲載ブログ'),$option)}} 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top:30px;">
                                            <div class="col-sm-3">
                                                <div class="angularsl" id="option1">
                                                    {{Form::select('option1', array('0' => '掲載', '1' => '掲載終了','2'=>'削除'))}} 
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                {{Form::submit('適用', array("class"=>"submit-blue-btn", 'value'=>'適用', 'name'=>'submit2', 'onclick'=> 'return check_del()'))}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-4 col-md-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="yes_all" id="select_all">
                                            </th>
                                            <th style="width:40%">タイトル</th>
                                            <th>作成者</th>
                                            <th>カテゴリー</th>
                                            <th>作成日</th>
                                            <th>ステータス</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if($result)
                                            @foreach ($result as $value)
                                            <tr>
                                                <td><label><input type="checkbox" class="all_check" name="yes[]" value="{{$value->id}}"> </label></td>
                                                <td>{{$value->title}}</td>
                                                <td>{{$value->user_name}}</td>
                                                <td>{{$value->category}}</td>
                                                <td>{{ date('Y年m月d日', strtotime($value->created_time)) }}</td>
                                                <td>{{$statusstring[$value->publication_setting]}}</td>
                                            </tr>
                                            @endforeach
                                       @endif
                                    </tbody>
                                </table>
                            </div>
                            {{ Form::close() }}
                            <div class="pagination">
                                {!! $result->links() !!}
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
        $(document).ready(function(){
            $('#select_all').change(function() {
                var checkboxes = $(this).closest('form').find(':checkbox');
                checkboxes.prop('checked', $(this).is(':checked'));
            });

            $(document).on('click', '#option .showoption div', function(){
                var parent_id = $(this).parent().parent().attr('id');
                var status_id = $('#'+parent_id).find('select').val();
                 $('input[name="form_option"]').val(status_id) ;  
                 console.log(status_id);           
            })
        })
        function check_del(){
            var len = $('input[name="yes[]"]:checked').length;
            if(len){
                return true;
            }else{
                alert("plz select one more blog!");
                return false;
            }
        }
    </script>
@endsection