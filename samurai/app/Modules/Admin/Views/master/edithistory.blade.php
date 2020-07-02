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
                                <li><a href="{{('/admin/master/loginhistory')}}">ログイン履歴</a></li>
                                <li class="active"><a href="{{('/admin/master/edithistory')}}">編集履歴</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="section-news">
                                <label style="font-size:20px">編集履歴</label>
                            </div>
                            <div class="row" style="margin-bottom:20px;">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-10">
                                    {{ Form::open(['url' => '/admin/master/edithistory', 'method' => 'GET', 'class' => 'form-horizontal searchPart']) }}
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
                                            <a href="/admin/master/edithistory?search={{request()->search}}&edit_time={{(request()->edit_time+1)%2}}&staff_id={{request()->staff_id}}&staff_name={{request()->staff_name}}&edit_page={{request()->edit_page}}&edit_content={{request()->edit_content}}&type=edit_time"></a>編集日時<span class="@if(request()->edit_time==1)table-arrow-top @else table-arrow @endif"></span></th>

                                            <th class="th-link" role="button" tabindex="0"><a href="/admin/master/edithistory?search={{request()->search}}&edit_time={{request()->edit_time}}&staff_id={{(request()->staff_id+1)%2}}&staff_name={{request()->staff_name}}&edit_page={{request()->edit_page}}&edit_content={{request()->edit_content}}&type=staff_id"></a>
                                            編集者ID<span class="table-arrow @if(request()->staff_id==1)table-arrow-top @else table-arrow  @endif"></span>
                                            </th>

                                            <th class="th-link" role="button" tabindex="0"><a href="/admin/master/edithistory?search={{request()->search}}&edit_time={{request()->edit_time}}&staff_id={{request()->staff_id}}&staff_name={{(request()->staff_name+1)%2}}&edit_page={{request()->edit_page}}&edit_content={{request()->edit_content}}&type=staff_name"></a>
                                            名前<span class="table-arrow @if(request()->staff_name==1) table-arrow-top @else table-arrow  @endif"></span>
                                            </th>

                                            <th class="th-link" role="button" tabindex="0"><a href="/admin/master/edithistory?search={{request()->search}}&edit_time={{request()->edit_time}}&staff_id={{request()->staff_id}}&staff_name={{request()->staff_name}}&edit_page={{(request()->edit_page+1)%2}}&type=edit_page"></a>
                                            編集ページ<span class="table-arrow @if(request()->edit_page==1) table-arrow-top @else table-arrow  @endif"></span>
                                            </th>

                                            <th class="th-link" role="button" tabindex="0"><a href="/admin/master/edithistory?search={{request()->search}}&edit_time={{request()->edit_time}}&staff_id={{request()->staff_id}}&staff_name={{request()->staff_name}}&edit_page={{(request()->edit_page+1)%2}}&edit_content={{(request()->edit_content+1)%2}}&type=edit_page"></a>
                                            編集内容<span class="table-arrow @if(request()->edit_page==1) table-arrow-top @else table-arrow  @endif"></span>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($edit_infos))
                                            @foreach($edit_infos as $val)
                                                <tr>
                                                    <td>{{$val->edit_time}}</td>
                                                    <td>{{$val->staff_id}}</td>
                                                    <td>{{$val->staff_name}}</td>
                                                    <td>{{$val->edit_page}}</td>
                                                    <td>{{$val->edit_content}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination">
                                {{ $edit_infos->appends(request()->query())->links('pagination.admin') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection