@extends('layouts.admin')
@section('style')
	<link rel="stylesheet" href="/assets/admin/css/employee.css">
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
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">施策データ管理</a><span>&gt;</span></li>
        <li><a>TOP</a></li>
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
                        <div class="sidebar-left" style="margin-bottom:90px;">
                            <ul>
                                <li><a href="/admin/employee">サイトへ</a></li>
                            </ul>
                        </div>
                        {{-- <div class="sidebar-left">
                            <ul>
                                <li><a href="{{URL::to('/admin/employee/csv')}}">csv管理</a></li>
                                <li><a href="{{URL::to('/admin/employee/uploadfile')}}">アップロードファイル管理</a></li>
                                <li><a href="{{URL::to('/admin/employee/email')}}">メール</a></li>
                            </ul>
                        </div> --}}
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
                            <div class="row" style="margin-left:6px;margin-right:6px;">
                                <div class="col-sm-4">
                                    <div class="home-colmenu-content">
                                        <strong>■収支管理</strong>
                                        <div class="home-colmenu-items">
                                            <p><a href="{{URL::to('/admin/employee/balance/sale')}}">・売上管理</a></p>
                                            <!-- <p><a href="{{URL::to('/admin/employee/balance/depwith')}}">・入出金管理</a></p> -->
                                            <p><a href="{{URL::to('/admin/employee/balance/payplan')}}">・支払予定管理</a></p>
                                            <!-- <p><a href="{{URL::to('/admin/employee/balance/data')}}">・データ総括</a></p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="home-colmenu-content">
                                        <strong>■システム管理</strong>
                                        <div class="home-colmenu-items">
                                            <p><a href="{{URL::to('/admin/employee/system/uservoice')}}">・利用者の声</a></p>
                                            <p><a href="{{URL::to('/admin/employee/system/alim')}}">・お知らせ</a></p>
                                            <!-- <p><a href="{{URL::to('/admin/employee/system/advertisement')}}">・広告表示管理</a></p> -->
                                            <p><a href="{{URL::to('/admin/employee/system/suggest')}}">・おススメの助成金</a></p>
                                            <p><a href="{{URL::to('/admin/employee/system/industry')}}">・業種</a></p>
                                            <p><a href="{{URL::to('/admin/employee/system/tag')}}">・タグ管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/system/category')}}">・カテゴリー管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/system/question')}}">・企業情報質問内容管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/system/payinfo')}}">・有料情報管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/system/notification')}}">・通知管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/system/blog')}}">・ブログ管理</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="home-colmenu-content">
                                        <strong>■顧客情報一覧</strong>
                                        <div class="home-colmenu-items">
                                            <!-- <p><a href="{{URL::to('/admin/employee/customerinfo/agencylist')}}">・士業一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customerinfo/clientlist')}}">・事業者一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customerinfo/matchinglist')}}">・マッチング一覧</a></p> -->
                                            <p><a href="{{URL::to('/admin/employee/customerinfo/new-user')}}">新規登録者一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customerinfo/agencylist')}}">士業情報一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customerinfo/clientlist')}}">企業情報一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customerinfo/violate-user')}}">違反者一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customerinfo/matchinglist')}}">マッチング管理</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-left:6px;margin-right:6px;">
                                <!-- <div class="col-sm-4">
                                    <div class="home-colmenu-content">
                                        <strong>■顧客対応一覧</strong>
                                        <div class="home-colmenu-items">
                                            <p><a href="{{URL::to('/admin/employee/customersupport/contact')}}">・お問い合わせ対応設定</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customersupport/identifydoc')}}">・本人確認書類管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customersupport/identifyphrase')}}">・本人確認書類対応設定</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customersupport/violator')}}">・違反者管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/customersupport/violatorphrase')}}">・違反者対応設定</a></p>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-sm-4">
                                    <div class="home-colmenu-content">
                                        <strong>■データ管理情報一覧</strong>
                                        <div class="home-colmenu-items">
                                            <p><a href="{{URL::to('/admin/employee/data/subsidylist')}}">・助成金データ</a></p>
                                            <!-- <p><a href="{{URL::to('/admin/employee/data/subsidyagency')}}">・士業登録助成金データ</a></p> -->
                                            <p><a href="{{URL::to('/admin/employee/data/subsidyadd')}}">・助成金データ新規登録</a></p>
                                            <p><a href="{{URL::to('/admin/employee/data/document')}}">・書類管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/data/registration')}}">・登録募集施策</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="home-colmenu-content">
                                        <strong>■その他管理</strong>
                                        <div class="home-colmenu-items">
                                            <!-- <p><a href="{{URL::to('/admin/employee/other/affiliate')}}">・アフィリエイター管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/payment')}}">・支払管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/companies')}}">・仕事提携可能会社一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/data')}}">・データ総括</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/seminardata')}}">・セミナーデータ一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/seminarapplicant')}}">・セミナー申込者一覧</a></p> -->
                                            <p><a href="{{URL::to('/admin/employee/other/affiliate')}}">アフィリエイター管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/payment')}}">支払管理</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/paydata')}}">支払管理データ総括</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/companies')}}">仕事提携可能会社一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/data')}}">仕事提携可能会社データ総括</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/seminardata')}}">セミナーデータ一覧</a></p>
                                            <p><a href="{{URL::to('/admin/employee/other/seminarapplicant')}}">セミナー申込者一覧</a></p>
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
	<script src="/assets/admin/js/employee.js"></script>
@endsection