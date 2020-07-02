@extends('layouts.admin')

@section('header_bottom')
    @includeIf('partials.admin.header_master')
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
<div ng-view="" style="">
    <div class="content">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <!-- <li class="active"><a href="{{URL::to('/admin/master/balancesale')}}">売上管理</a></li> -->
                                <li><a href="{{URL::to('/admin/master/balancedepwith')}}">入出金管理</a></li>
                                <li><a href="{{URL::to('/admin/master/balancepayplan')}}">支払予定管理</a></li>
                                <li><a href="{{URL::to('/admin/master/balancedata')}}">データ総括</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="section-1">
                                <div class="success-msg">
                                    <span>csvを出力しました。</span>
                                </div>
                            </div>

                            <div class="section-2 col-md-12">
                                {{ Form::open(['url' => '/admin/master/balancesale', 'method' => 'GET', 'class' => 'form-horizontal']) }}
                                    <!-- @csrf -->
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">請求コード</p>
                                                <div class="col-sm-7">
                                                    {{Form::text('order_id', request()->order_id, ['class'=>'form-control', 'placeholder'=>'支払コード'])}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <p class="col-sm-3">請求日</p>
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
                                                <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">~</p>
                                                <div class="col-sm-3" style="padding-left:0px;padding-right:0px;">
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
                                                <p class="col-sm-3">請求会社名</p>
                                                <div class="col-sm-7">
                                                    {{Form::text('to_user_name', request()->to_user_name, ['class'=>'form-control', 'placeholder'=>'支払先会社名'])}}
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">ステータス</p>
                                                <div class="col-sm-7 balancesale">
                                                    <div class="angularsl">
                                                        {{Form::select('status', [null=>'すべて'] + $sale_statuses, request()->status)}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">項目</p>
                                                <div class="col-sm-7 balancesale">
                                                    <div class="angularsl">
                                                        {{Form::select('summary_id', ['' => 'すべて'], request()->status)}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <p class="col-sm-3">入金日</p>
                                                <div class="col-sm-3" style="padding-right:0px;">
                                                    <input class="form-control" type="text" ng-model="searchsetting.name">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control" type="text" ng-model="searchsetting.name">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control" type="text" ng-model="searchsetting.name">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <p class="col-sm-1" style="padding-left:0px;padding-right:0px;">~</p>
                                                <div class="col-sm-3" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control" type="text" ng-model="searchsetting.name">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control" type="text" ng-model="searchsetting.name">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-1" style="padding-left:0px;padding-right:0px;">
                                                    <input class="form-control" type="text" ng-model="searchsetting.name">
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top:50px;">
                                        {{Form::submit('表示する', ['class'=>'submit-blue-btn'])}}
                                    </div>
                                {{ Form::close() }}
                            </div>

                            <div class="section-3 col-md-12">
                                <h4 style="margin-bottom:20px;width:100%;">売上管理一覧</h4>
                                <div class="row" style="margin-bottom:20px;margin-top:20px;">

                                    <div class="col-sm-12">
                                        <form class="searchPart">
                                            <div style="display: inline;margin-left:30px;">{{count($payments)}}件表示 / {{$total}}件</div>
                                                <a href="csv/down_balance_sale?order_id={{request()->order_id}}&request_year_from={{request()->request_year_from}}&request_month_from={{request()->request_month_from}}&request_day_from={{request()->request_day_from}}&request_year_to={{request()->request_year_to}}&request_month_to={{request()->request_month_to}}&request_day_to={{request()->request_day_to}}&to_user_name={{request()->to_user_name}}&status={{request()->status}}&summary_id={{request()->summary_id}}" class="submit-blue-searchright" style="margin-right:20px;">csv出力</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;">
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="min-width:120px;">請求コード</th>
                                            <th>請求日</th>
                                            <th>ユーザー名</th>
                                            <th>概要</th>
                                            <th>名目</th>
                                            <th>入金</th>
                                            <th>出金</th>
                                            <th>残高</th>
                                            <th>ステータス</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($payments))
                                        @foreach($payments as $val)
                                        <tr>
                                            <td>{{$val->order_id}}</td>
                                            <td>{{$val->created_time}}</td>
                                            <td>{{$val->order_id}}</td>
                                            <td>{{$val->summary}}</td>
                                            <td>{{$val->summary_sub}}</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{$val->balance}}</td>
                                            <td>{{config('combobox.payment_status')[$val->status]}}</td>
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