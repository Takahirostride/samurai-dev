@extends('layouts.admin')
@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('content')
<div class="customerinfo">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        @include('Admin::employee.customerinfo.sidebar')
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">                            
                            <div class="blueheading customer"><span>違反者一覧</span></div>
                            @include('Admin::employee/customerinfo/filter_violate')
                            @include('Admin::employee/customerinfo/display_result')
                            {!! Form::open(['url'=>request()->url(),'method'=>'get']) !!}
                            <div class="section-5  olRowlink col-md-12" style="overflow-x:auto;display:block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>違反報告日</th>
                                            <th>ユーザーID</th>
                                            <th>登録者名</th>
                                            <th>都道府県</th>
                                            <th>登録区分</th>
                                            <th>ステータス</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($values as $value)
                                            @php
                                                $link = $value->userReport->manage_flag == 1 ? route('admin.agencydetail.violation',['id'=>$value->report_id]) : route('admin.clientdetail.violation',['id'=>$value->report_id])
                                            @endphp
                                            <tr data-link="{{ $link }}">
                                                <td>{{ ol_get_date_string($value->created_date)}}</td>
                                                <td>{{ $value->report_id }}</td>
                                                <td>{{ $value->userReport->username}}</td>        
                                                <td>{{ ($value->userReport->userLocation) ? $value->userReport->userLocation->provinceName():'' }}</td>
                                                <td>{{ $value->userReport->sectionName()}}</td>
                                                <td>{{ $value->stateName()}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! Form::close() !!}
                            {!! $values->appends(request()->query())->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection