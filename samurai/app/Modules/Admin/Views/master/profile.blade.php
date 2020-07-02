@extends('layouts.admin')

@section('header_bottom')
    @includeIf('partials.admin.header_master')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">マスター管理</a><span>&gt;</span></li>
        <li><a>システム管理</a></li>
    </ul>
</div>
@endsection
@section('content')
<!-- ngView: -->
<div>
    <div class="content">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <li class="active"><a href="{{('/admin/master/profile')}}">システム設定</a></li>
                                <li><a href="{{('/admin/master/employeeedit')}}">スタッフ登録</a></li>
                                <li><a href="{{('/admin/master/loginhistory')}}">ログイン履歴</a></li>
                                <li><a href="{{('/admin/master/edithistory')}}">編集履歴</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <label style="font-size:22px;">ログイン設定</label>
                        </div>
                        <div class="site-content">
                            @includeIf('partials.admin.flash')
                            {{ Form::open(['url' => '/admin/master/profile', 'method' => 'POST', 'class' => 'form-horizontal', 'data-toggle'=>'validator', 'id'=>'profile_validate']) }}
                                <div class="section-2 col-md-12">
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-11">
                                        <div class="form-group" style="margin-top:30px;">
                                            <p class="col-sm-4">現在の管理者ID</p>
                                            <div class="col-sm-5">
                                                {{Form::text('beforeid', request()->order_id, ['class'=>'form-control', 'placeholder'=>'現在の管理者ID', 'required'=>'required'])}}
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-top:20px;">
                                            <p class="col-sm-4">現在の管理者パスワード</p>
                                            <div class="col-sm-5">
                                                {{Form::text('beforepassword', request()->beforepassword, ['class'=>'form-control', 'placeholder'=>'8文字以上', 'required'=>'required'])}}
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-top:20px;">
                                            <p class="col-sm-4">新しい管理者ID</p>
                                            <div class="col-sm-5">
                                                {{Form::text('nextid', request()->order_id, ['class'=>'form-control', 'placeholder'=>'8文字以上', 'required'=>'required', 'minlength'=>'8'])}}
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-top:20px;">
                                            <p class="col-sm-4">新しい管理者パスワード</p>
                                            <div class="col-sm-5">
                                                {{Form::text('nextpassword', request()->nextpassword, ['class'=>'form-control', 'placeholder'=>'8文字以上', 'required'=>'required', 'minlength'=>8, 'type'=>'password', 'id'=>'inputPassword'])}}
                                                <p style="font-size:12px;margin-left:10px;">確認のため再入力</p>
                                                {{Form::text('nextpasswordverify', request()->nextpasswordverify, ['class'=>'form-control', 'placeholder'=>'8文字以上', 'required'=>'required', 'minlength'=>8, 'type'=>'password', 'data-match'=>'#inputPassword'])}}
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div style="margin-top:50px;">
                                    {{Form::submit('設定変更', ['class'=>'submit-blue-btn'])}}
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
        $('#profile_validate').validator();
    </script>
@endsection