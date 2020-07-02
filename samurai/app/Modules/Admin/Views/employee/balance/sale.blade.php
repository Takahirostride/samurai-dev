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
<div ng-view="" style="">
    <div class="content">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <li class="active"><a href="{{URL::to('/admin/employee/balance/sale')}}">売上管理</a></li>
                                {{-- <li><a href="{{URL::to('/admin/employee/balance/depwith')}}">入出金管理</a></li> --}}
                                <li><a href="{{URL::to('/admin/employee/balance/payplan')}}">支払予定管理</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content pdt-20">
                            @include('Admin::employee.balance.filters.filter_balance',compact('filters'))

                            <div class="section-3 col-md-12">
                                <h4 style="margin-bottom:20px;width:100%;">売上管理一覧</h4>
                                <div class="row" style="margin-bottom:20px;margin-top:20px;">

                                    <div class="col-sm-12">
                                        <form class="searchPart">
                                            <div style="display: table;float: right;">{{count($payments)}}件表示 / {{$payments->total()}}件</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="scroll-tb">
                                    <table class="table table-bordered thbgr text-center" style="width:1300px">
                                        <thead>
                                            <tr>
                                                <th style="min-width:90px;">番号</th>
                                                <th style="min-width:150px;">日付</th>
                                                <th style="min-width:120px;">振込<br>ユーザー名</th>
                                                <th>案件タイトル</th>
                                                <th style="min-width:120px;">士業<br>ステータス</th>
                                                <th style="min-width:120px;">企業<br>支払金額</th>
                                                <th style="min-width:120px;">企業<br>ステータス</th>
                                                <th style="min-width:120px;">士業<br>報酬金額</th>
                                                <th>SAMURAI<br>利益</th>
                                                <th style="min-width:170px;">SAMURAI<br>士業支払ステータス</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($payments))
                                            @foreach($payments as $val)
                                            <tr>
                                                <td rowspan="2">{{@$val->invoice->order_id}}</td>
                                                <td rowspan="2">{{date('Y年m月d日',strtotime($val->matching_date))}}</td>
                                                <td rowspan="2">
                                                    @php
                                                        $client = $val->getClient();
                                                    @endphp
                                                    @if($client)
                                                        {{ $client->displayname ? $client->displayname : $client->username }}
                                                    @endif
                                                </td>
                                                <td rowspan="2"><a href="{{ route('admin.employee.data.subsidy_edit',['id'=>@$val->policy->id]) }}">{{@$val->policy->name}}</a></td>
                                                <td>見請求</td>
                                                <td>着手金{{@$val->deposit_money}}</td>
                                                <td>支払済</td>
                                                <td>90,000</td>
                                                <td>未払い{{-- {{config('combobox.payment_status')[$val->status]}} --}}</td>
                                                <td>未払い</td>
                                            </tr>
                                            <tr>
                                                <td>請求済</td>
                                                <td>後払い{{@$val->agency_estimate}}</td>
                                                <td>未払い</td>
                                                <td>90,000</td>
                                                <td>支払済{{@config('combobox.payment_status')[@$val->invoice->status]}}</td>
                                                <td>支払済<br>返金</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
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