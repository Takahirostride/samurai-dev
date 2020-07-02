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
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <li><a href="{{('/admin/master/csvmanagement')}}">csv管理</a></li>
                                <li class="active"><a href="{{('/admin/master/uploaded')}}">アップロードファイル管理</a></li>
                                <li><a href="{{('/admin/master/scrape')}}">クローリング</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="title">マッチング一覧</h3>
                                @include('Admin::employee.customerinfo.filters.filter_matching_list',compact('filters'))
                            </div>
                            <div class="col-sm-12">
                                <div class="list-results text-right">
                                    <span class="result">{{ $matching_lists->count() }}件表示 / {{ $matching_lists->total() }}件</span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="scroll-tb">
                                    <table class="table table-bordered thbgr text-center" style="width:1300px">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th style="width:140px;">マッチング日</th>
                                                <th style="width:140px;">アップロード日</th>
                                                <th>案件タイトル</th>
                                                <th>アップロード　企業名</th>
                                                <th>アップロード士業名</th>
                                                <th style="width:320px;">アップロードファイル</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($matching_lists)
                                            @foreach($matching_lists as $key => $matching_list)
                                            @php 
                                                $vnuk = $key+1;
                                            @endphp
                                            <tr>
                                                <td>{{$vnuk}}</td>
                                                <td>{{\Carbon\Carbon::parse($matching_list->matching_date)->format('Y年m月d日')}}</td>
                                                <td>{{\Carbon\Carbon::parse($matching_list->update_date)->format('Y年m月d日')}}</td>
                                                <td><a href="{{ route('admin.employee.data.subsidy_edit',['id'=>$matching_list->policy->id]) }}">{{$matching_list->policy->name}}</a></td>
                                                <td>
                                                    @php
                                                        $client = $matching_list->getClient();
                                                    @endphp
                                                    @if($client)
                                                        {{ $client->displayname ? $client->displayname : $client->username }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $agency = $matching_list->getAgency();
                                                    @endphp
                                                    @if($agency)
                                                    {{ $agency->displayname ? $agency->displayname : $agency->username }}
                                                    @endif
                                                </td>
                                                <td class="filesshow">
                                                    @foreach ($matching_list->workset as $element)

                                                    <li>
                                                        <div class="avatar ite_file">
                                                            @include('Admin::employee.customerinfo.partials.content_file',['element'=>$element])
                                                        </div>
                                                        <p class="name">{{str_limit($element->file_name, 10)}}</p>
                                                    </li>
                                                    @endforeach
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="pagination">
                                {{ $matching_lists->appends(request()->query())->links('pagination.admin') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection