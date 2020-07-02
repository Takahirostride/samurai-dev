@extends('layouts.admin')

@section('header_bottom')
    @includeIf('partials.admin.header_master')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">マスター管理</a><span>&gt;</span></li>
        <li><a>TOP</a></li>
    </ul>
</div>
@endsection
@section('content')
<!-- ngView: -->
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <li class="active"><a href="{{('/admin/master/csvmanagement')}}">csv管理</a></li>
                                <li><a href="{{('/admin/master/uploaded')}}">アップロードファイル管理</a></li>
                                <li><a href="{{('/admin/master/scrape')}}">クローリング</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <label style="font-size:22px; margin-left:10px; ">csv読込・出力</label>
                        </div>
                        <div class="site-content">
                            @includeIf('partials.admin.flash')
                            <div class="section-2 col-md-12">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-11">
                                    {{ Form::open(['url' => '/admin/master/import_user/0', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                        <div class="form-group" style="margin-top:30px;">
                                            <p class="col-sm-2">士業一覧</p>
                                            <div class="col-sm-5">
                                                {{Form::file('filecsv', ['class'=>'form-control'])}}
                                            </div>
                                             {{Form::submit('読込', ['class'=>'submit-blue-left', 'style'=>'width:100px'])}}
                                            <a href="/admin/master/down_user/0" class="submit-blue-left" style="width:100px;">出力</a>
                                        </div>
                                    {{ Form::close() }}
                                    {{ Form::open(['url' => '/admin/master/import_user/1', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                        <div class="form-group" style="margin-top:30px;">
                                            <p class="col-sm-2">事業者一覧</p>
                                            <div class="col-sm-5">
                                                {{Form::file('filecsv', ['class'=>'form-control'])}}
                                            </div>
                                             {{Form::submit('読込', ['class'=>'submit-blue-left', 'style'=>'width:100px'])}}
                                            <a href="/admin/master/down_user/1" class="submit-blue-left" style="width:100px;">出力</a>
                                        </div>
                                    {{ Form::close() }}
                                    {{ Form::open(['url' => '/admin/master/import_affiliate', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                        <div class="form-group" style="margin-top:30px;">
                                            <p class="col-sm-2">アフィリエイター一覧</p>
                                            <div class="col-sm-5">
                                                {{Form::file('filecsv', ['class'=>'form-control'])}}
                                            </div>
                                             {{Form::submit('読込', ['class'=>'submit-blue-left', 'style'=>'width:100px'])}}
                                            <a href="/admin/master/down_affiliate" class="submit-blue-left" style="width:100px;">出力</a>
                                        </div>
                                    {{ Form::close() }}
                                    {{ Form::open(['url' => '/admin/master/import_affiliate', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                        <div class="form-group" style="margin-top:30px;">
                                            <p class="col-sm-2">仕事提携会社一覧</p>
                                            <div class="col-sm-5">
                                                {{Form::file('filecsv', ['class'=>'form-control'])}}
                                            </div>
                                             {{Form::submit('読込', ['class'=>'submit-blue-left', 'style'=>'width:100px'])}}
                                            <a href="#" class="submit-blue-left" style="width:100px;">出力</a>
                                        </div>
                                    {{ Form::close() }}    
                                    {{ Form::open(['url' => '/admin/master/import_matching', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                        <div class="form-group" style="margin-top:30px;">
                                            <p class="col-sm-2">マッチング一覧</p>
                                            <div class="col-sm-5">
                                                {{Form::file('filecsv', ['class'=>'form-control'])}}
                                            </div>
                                             {{Form::submit('読込', ['class'=>'submit-blue-left', 'style'=>'width:100px'])}}
                                            <a href="/admin/master/down_matching" class="submit-blue-left" style="width:100px;">出力</a>
                                        </div>
                                    {{ Form::close() }} 
                                    {{ Form::open(['url' => '/admin/master/import_policy', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                        <div class="form-group" style="margin-top:30px;">
                                            <p class="col-sm-2">助成金データ</p>
                                            <div class="col-sm-5">
                                                {{Form::file('filecsv', ['class'=>'form-control'])}}
                                            </div>
                                             {{Form::submit('読込', ['class'=>'submit-blue-left', 'style'=>'width:100px'])}}
                                            <a href="/admin/master/down_policy" class="submit-blue-left" style="width:100px;">出力</a>
                                        </div>
                                    {{ Form::close() }} 
                                    {{ Form::open(['url' => '/admin/master/import_agency_policy', 'method' => 'POST', 'class' => 'form-horizontal', 'enctype'=>'multipart/form-data']) }}
                                        <div class="form-group" style="margin-top:30px;">
                                            <p class="col-sm-2">助成金データ</p>
                                            <div class="col-sm-5">
                                                {{Form::file('filecsv', ['class'=>'form-control'])}}
                                            </div>
                                             {{Form::submit('読込', ['class'=>'submit-blue-left', 'style'=>'width:100px'])}}
                                            <a href="/admin/master/down_agency_policy" class="submit-blue-left" style="width:100px;">出力</a>
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
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('form').submit(function(){
                obj = $(this);
                file = obj.find('input[name="filecsv"]').val();
                if(file===""){
                    alert('ファイルを選択してください。');
                    return false;
                }
            })
        });
    </script>
@endsection