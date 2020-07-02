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
                            <div class="blueheading customer"><span>士業情報一覧</span></div>
                            @include('Admin::employee/customerinfo/filter_agency')
                            @include('Admin::employee/customerinfo/display_result')
                            {!! Form::open(['url'=>request()->url(),'method'=>'get']) !!}
                            <div class="section-5 olRowlink col-md-12 tb-infomation">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>登録日</th>
                                            <th>{!! ol_get_sort_link('id','ユーザーID') !!}</th>
                                            <th>登録者名</th>
                                            <th>都道府県</th>
                                            <th>士業種別</th>
                                            <th>最終ログイン日</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($values as $value)
                                            <tr data-link="{{ route('admin.StaffPolicyController.edit_agency',$value) }}">
                                                <td>{{ $value->CreatedAtName()}}</td>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->username }}</td>
                                                <td>{{ $value->userLocation ? $value->userLocation->provinceName():'' }}</td>
                                                <td>{{ $value->user_agency_type ? $value->user_agency_type->agency_type:'' }}</td>
                                                <td>{{ $value->getLoginDate() }}</td>
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