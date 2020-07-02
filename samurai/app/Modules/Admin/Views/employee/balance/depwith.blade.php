@extends('layouts.admin')

@section('header_bottom')
    @includeIf('partials.admin.header_employee')
@endsection
@section('breadcrumb')
<div class="breadcrumb" style="margin-bottom:0px;">
    <ul>
        <li><a href="">マスター管理</a><span>&gt;</span></li>
        <li><a>収支管理</a></li>
    </ul>
</div>
@endsection
@section('content')
<!-- ngView: -->
<div style="">
    <div class="content ">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <li><a href="{{URL::to('/admin/employee/balance/sale')}}">売上管理</a></li>
                                <li class="active"><a href="{{URL::to('/admin/employee/balance/depwith')}}">入出金管理</a></li>
                                <li><a href="{{URL::to('/admin/employee/balance/payplan')}}">支払予定管理</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="section-2 col-md-12">
                                {{ Form::open(['url' => '/admin/master/balancedepwith', 'method' => 'GET', 'class' => 'form-horizontal']) }}
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <p class="col-sm-3">日付</p>
                                                <div class="col-sm-3" style="padding-right:0px;">
                                                    {{Form::number('request_year_from',request()->request_year_from, ['class'=>'form-control', 'min'=>'2018', 'max'=>'2100'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('request_month_from',request()->request_month_from, ['class'=>'form-control', 'min'=>'1', 'max'=>'12'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('request_day_from',request()->request_day_from, ['class'=>'form-control', 'min'=>'1', 'max'=>'12'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <p class="col-sm-3">日付</p>
                                                <div class="col-sm-3" style="padding-right:0px;">
                                                    {{Form::number('request_year_to',request()->request_year_to, ['class'=>'form-control', 'min'=>'2018', 'max'=>'2100'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('request_month_to',request()->request_month_to, ['class'=>'form-control', 'min'=>'1', 'max'=>'12'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('request_day_to',request()->request_day_to, ['class'=>'form-control', 'min'=>'1', 'max'=>'31'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">口座名</p>
                                                <div class="col-sm-7">
                                                    {{Form::text('order_id', request()->order_id, ['class'=>'form-control', 'placeholder'=>'支払コード'])}}
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">社名</p>
                                                <div class="col-sm-7">
                                                    {{Form::text('to_user_name', request()->to_user_name, ['class'=>'form-control', 'placeholder'=>'支払先会社名'])}}
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">科目</p>
                                                <div class="col-sm-7 balancesale">
                                                    <div class="angularsl">
                                                        {{Form::select('status', $depwith_statuses, request()->status)}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">摘要</p>
                                                <div class="col-sm-7 balancesale">
                                                    <div class="angularsl">
                                                        {{Form::select('summary_id', ['' => 'すべて'], request()->status)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top:50px;">
                                        {{Form::submit('表示する', ['class'=>'submit-blue-btn'])}}
                                    </div>
                                {{ Form::close() }}
                            </div>

                            <div class="section-3 col-md-12">
                                <h4 style="margin-bottom:20px;">入出金管理一覧</h4>
                                <div class="row" style="margin-bottom:20px;margin-top:20px;">

                                    <div class="col-sm-12">
                                        <div style="display: inline;margin-left:30px;">{{count($payments)}}件表示 / {{$total}}件</div>
                                        <a href="csv/down_balance_depwith?order_id={{request()->order_id}}&request_year_from={{request()->request_year_from}}&request_month_from={{request()->request_month_from}}&request_day_from={{request()->request_day_from}}&request_year_to={{request()->request_year_to}}&request_month_to={{request()->request_month_to}}&request_day_to={{request()->request_day_to}}&to_user_name={{request()->to_user_name}}&status={{request()->status}}&summary_id={{request()->summary_id}}" class="submit-blue-searchright" style="margin-right:20px;">csv出力</a>
                                    </div>
                                </div>
                            </div>

                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="min-width:120px;">日付</th>
                                            <th>社名</th>
                                            <th>科目</th>
                                            <th>摘要</th>
                                            <th>入金額</th>
                                            <th>出金額</th>
                                            <th>差引残高</th>
                                            <th>ステータス</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($payments))
                                        @foreach($payments as $val)
                                        <tr>
                                            <td>{{$val->created_time}}</td>
                                            <td></td>
                                            <td>{{$val->summary}}</td>
                                            <td>{{$val->summary_sub}}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{$val->balance}}</td>
                                            <td>@php print_r(config('site_config.payment_status')[$val->status]); @endphp</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                {{ $payments->appends(request()->query())->links('pagination.admin') }} 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection