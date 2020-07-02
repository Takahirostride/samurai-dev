@extends('layouts.admin')
@section('style')
	<link rel="stylesheet" href="/assets/admin/css/employee.css">
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
                        <div class="sidebar-left">
                            <ul>
                                <li class="active"><a href="{{URL::to('/admin/employee/csv')}}">csv管理</a></li>
                                <li><a href="{{URL::to('/admin/employee/uploadfile')}}">アップロードファイル管理</a></li>
                                <!-- <li><a href="{{URL::to('/admin/employee/email')}}">メール</a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="section-news">
                                <label style="font-size:30px">Coming Soon...</label>
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