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
                                <div style="float:left;padding-left:100px;">
                                   <a class="submit-blue-btn" href=" {{URL::to('/admin/employee/system/alimadd')}}">新規追加</a>
                                </div>
                            </div>
                            {{ Form::open(['url' => '/admin/employee/system/alim', 'method' => 'POST', 'class' => 'form-horizontal']) }}
                            <div class="section-3 col-md-12">
                                <h4 style="background-color:#F4F4F4;margin-left:10px;">お知らせ一覧</h4>
                                <div class="section3-full">
                                    <div class="section3-full-scroll">
                                        @if (!empty($result))
                                            @foreach($result as $index => $val)
                                            <div class="row" style="margin-bottom:20px;">
                                                <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">お知らせ{{$index+1}}</p>
                                                <div class="col-sm-11">
                                                    <div class="row" style="margin-bottom:10px;">
                                                        <p class="col-sm-2" style="padding-left:15px;padding-right:0px;">タイトル:</p>
                                                        <div class="col-sm-9">
                                                            {{FORM::text('title['.$val->id.']', $val->title, ['class'=>'form-control'])}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                         <a class="submit-blue-btn" href=" {{URL::to('/admin/employee/system/alimedit/'.$val->id)}}">詳細設定</a>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <p>{{\Carbon\Carbon::parse($val->created_date)->format('Y年m月d日')}}</p>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="angularsl">
                                                                 {{Form::select('publication_setting['.$val->id.']', ['1'=>'公開', '0'=>'非公開'], $val->publication_setting)}}
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                         <a class="btn btn-danger btn-style-shadow-red" href=" {{URL::to('/admin/employee/system/alimdelete/'.$val->id)}}">削除する</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                         @endif
                                    </div>
                                </div>
                            </div>
                            <div class="pagination">
                                {{ $result->appends(request()->query())->links('pagination.admin') }} 
                            </div>
                            <div style="margin-top:50px;">
                              {{Form::submit('保存する', ['class'=>'submit-blue-btn'])}}
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