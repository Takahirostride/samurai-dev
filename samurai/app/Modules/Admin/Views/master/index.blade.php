@extends('layouts.admin')
@section('style')
	<link rel="stylesheet" href="/assets/admin/css/master.css">
    <style type="text/css">
        .t-fix {
            height: 265px;
            overflow-y: scroll;
            position: relative;
            width: 100%;
        }
        .site-content{
            position: relative;
        }
        .site-content:after{
            width: calc(100% - 20px) ;
            height: 1em;
            position: absolute;
            z-index: 10;
            background: #fff;
            content: '';
            left: 0;
            bottom: 0;
        }
        .site-content:before{
            width: calc(100% - 20px) ;
            height: 1em;
            position: absolute;
            z-index: 10;
            background: #fff;
            content: '';
            left: 0;
            top: 0;
        }
    </style>
@endsection
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
<div class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left" style="margin-bottom:90px;">
                            <ul>
                                <li><a href="{{('/admin/master')}}">サイトへ</a></li>
                            </ul>
                        </div>
                        <div class="sidebar-left">
                            <ul>
                                <li><a href="{{('/admin/master/csvmanagement')}}">csv管理</a></li>
                                <li><a href="{{('/admin/master/uploaded')}}">アップロードファイル管理</a></li>
                                <li><a href="{{('/admin/master/scrape')}}">クローリング</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="section-news t-fix">
                                @if($infos)
                                    @foreach($infos as $info)
                                        <div class="success-msg">
                                            <span>{{$info->edit_time}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$info->edit_content}}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="site-content" style="margin-top:30px;">
                            <div class="col-sm-4">
                                <div class="home-colmenu-content">
                                    <strong>■収支管理</strong>
                                    <div class="home-colmenu-items">
                                        <!-- <p><a href="{{('/admin/master/balancesale')}}">・売上管理</a></p> -->
                                        <p><a href="{{('/admin/master/balancedepwith')}}">・入出金管理</a></p>
                                        <p><a href="{{('/admin/master/balancepayplan')}}">・支払予定管理</a></p>
                                        <p><a href="{{('/admin/master/balancedata')}}">・データ総括</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="home-colmenu-content">
                                    <strong>■システム管理一覧</strong>
                                    <div class="home-colmenu-items">
                                        <p><a href="{{('/admin/master/profile')}}">・システム設定</a></p>
                                        <p><a href="{{('/admin/master/employeeedit')}}">・スタッフ登録</a></p>
                                        <p><a href="{{('/admin/master/loginhistory')}}">・ログイン履歴</a></p>
                                        <p><a href="{{('/admin/master/edithistory')}}">・編集履歴</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="home-colmenu-content">
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