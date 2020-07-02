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
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <li><a href="{{('/admin/master/profile')}}">システム設定</a></li>
                                <li><a href="{{('/admin/master/employeeedit')}}">スタッフ登録</a></li>
                                <li class="active"><a href="{{('/admin/master/loginhistory')}}">ログイン履歴</a></li>
                                <li><a href="{{('/admin/master/edithistory')}}">編集履歴</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="section-news">
                                <label style="font-size:20px">ログイン履歴</label>
                            </div>
                            <div class="row" style="margin-bottom:20px;">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-10">
                                    {{ Form::open(['url' => '/admin/master/loginhistory', 'method' => 'GET', 'class' => 'form-horizontal searchPart']) }}
                                        <!-- <i class="glyphicon glyphicon-search"></i> -->
                                        <button type="reset"  style="margin-left:10px;" class="submit-blue-search">クリア</button>
                                        <button type="submit" class="submit-blue-search">検索</button>
                                        <input type="text" name="search" placeholder="" name="search">
                                    {{ Form::close() }}
                                </div>
                            </div>

                            <div class="section-5 col-md-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="min-width: 150px" class="th-link" role="button" tabindex="0">
                                            <a href="/admin/master/loginhistory?search={{request()->search}}&logged_time={{(request()->logged_time+1)%2}}&staff_id={{request()->staff_id}}&staff_name={{request()->staff_name}}&ipaddress={{request()->ipaddress}}&type=logged_time"></a>ログイン日時<span class="@if(request()->logged_time==1)table-arrow-top @else table-arrow @endif"></span></th>

                                            <th class="th-link" role="button" tabindex="0"><a href="/admin/master/loginhistory?search={{request()->search}}&logged_time={{request()->logged_time}}&staff_id={{(request()->staff_id+1)%2}}&staff_name={{request()->staff_name}}&ipaddress={{request()->ipaddress}}&type=staff_id"></a>
                                            ログインID<span class="table-arrow @if(request()->staff_id==1)table-arrow-top @else table-arrow  @endif"></span>
                                            </th>

                                            <th class="th-link" role="button" tabindex="0"><a href="/admin/master/loginhistory?search={{request()->search}}&logged_time={{request()->logged_time}}&staff_id={{request()->staff_id}}&staff_name={{(request()->staff_name+1)%2}}&ipaddress={{request()->ipaddress}}&type=staff_name"></a>
                                            名前<span class="table-arrow @if(request()->staff_name==1) table-arrow-top @else table-arrow  @endif"></span>
                                            </th>

                                            <th class="th-link" role="button" tabindex="0"><a href="/admin/master/loginhistory?search={{request()->search}}&logged_time={{request()->logged_time}}&staff_id={{request()->staff_id}}&staff_name={{request()->staff_name}}&ipaddress={{(request()->ipaddress+1)%2}}&type=ipaddress"></a>
                                            IPアドレス<span class="table-arrow @if(request()->ipaddress==1) table-arrow-top @else table-arrow  @endif"></span>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($login_infos))
                                            @foreach($login_infos as $val)
                                                <tr>
                                                    <td>{{$val->logged_time}}</td>
                                                    <td>{{$val->staff_id}}</td>
                                                    <td>{{$val->staff_name}}</td>
                                                    <td>{{$val->ipaddress}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination">
                                {{ $login_infos->appends(request()->query())->links('pagination.admin') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection