@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
@include('Admin::partials.breadcrumb',['pagename'=>'システム管理'])
@endsection
@section('content')
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        @include('Admin::employee.customerinfo.sidebar')
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content noborder">
                            <div class="blueheading"><span>マッチング一覧</span></div>

                            @include('Admin::employee.customerinfo.filters.filter_matching_list',compact('filters'))
                            @include('Admin::employee/customerinfo/display_result')
                            {!! Form::open(['url'=>request()->url(),'method'=>'get']) !!}
                            <div class="section-5 olcbBlue col-md-12" style="overflow-x:auto;display:block;">
                                <table class="oltable oltable-white">
                                    <thead>
                                        <tr>
                                            <th class="td-date">マッチング日</th>
                                            <th class="td-date">予定納期</th>
                                            <th class="td-date">終了報告日</th>
                                            <th>案件タイトル</th>
                                            <th class="td-name">事業者名</th>
                                            <th class="td-name">士業名</th>
                                            <th>着手金</th>
                                            <th>後払い金額</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($values as $value)  
                                            @include('Admin::employee.customerinfo.partials.content_hire',['value'=>$value])
                                            @include('Admin::employee.customerinfo.partials.content_work_set',['value'=>$value])
                                        @endforeach                 
                                    </tbody>
                                </table>
                            </div>
                            {!! Form::close() !!}
                            {!! empty($values) ? '': $values->appends(request()->query())->links() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection