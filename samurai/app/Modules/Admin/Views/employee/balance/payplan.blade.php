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
<div ng-view="" class="ng-scope" style="">
    <div class="content ng-scope">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <li><a href="{{URL::to('/admin/employee/balance/sale')}}">売上管理</a></li>
                               {{--  <li><a href="{{URL::to('/admin/employee/balance/depwith')}}">入出金管理</a></li> --}}
                                <li class="active"><a href="{{URL::to('/admin/employee/balance/payplan')}}">支払予定管理</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                           {{--  <div class="section-1">
                                <div class="success-msg">
                                    <span>csvを出力しました。</span>
                                </div>
                            </div> --}}

                            @include('Admin::employee.balance.filters.filter_balance_payplan',compact('filters'))
                            <div class="section-4 col-md-12" style="overflow-x:auto;display:block;margin-top:20px;">
                                <table class="table table-bordered thbgr text-center">
                                    <thead>
                                        <tr>
                                            <th>番号</th>
                                            <th style="min-width:120px;">支払い日付</th>
                                            <th>振込口座情報</th>
                                            <th>案件タイトル</th>
                                            <th>振込手数料</th>
                                            <th>支払金額</th>
                                            <th>士業<br>報酬金額</th>
                                            <th>SAMURAI<br>支払ステータス</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($payments))
                                        @foreach($payments as $val)
                                        <tr>
                                            <td>{{@$val->order_id}}</td>
                                            <td>{{@$val->created_time}}</td>
                                            <td>{{@$val->summary}}</td>
                                            <td><a href="{{ route('admin.employee.data.subsidy_edit',['id'=>@$val->hire->policy->id]) }}">{{@$val->hire->policy->name}}</a></td>
                                            <td>{{@$val->hire->deposit_money}}</td>
                                            <td>{{@$val->hire->agency_estimate}}</td>
                                            <td>{{@$val->hire->client_pay}}</td>
                                            <td>
                                                {!! Form::select('status', config('combobox.payplan_statuses') , $val->status,['class'=>'form-control chang_status','data-id'=>@$val->id]) !!}
                                            </td>
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
@section('script')
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('change' , '.chang_status' , function(){
            var payment_id = $(this).attr('data-id');
            var status = $(this).val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            console.log(payment_id);
            $.confirm({
                boxWidth: '320px',
                useBootstrap: false,
                title: 'ポップアップで変更しますか？',
                content: false,
                titleClass: 'font20',
                buttons: {
                    いいえ: {
                        btnClass: 'btn-bookmark-cf',
                        action: function(){
                            close();
                        }
                    },
                    はい: {
                        btnClass: 'btn-bookmark-cf', 
                        action: function(){
                            $.ajax({
                                url: '{{route('employee.balance.chang_status')}}',
                                data: {_token: CSRF_TOKEN, payment_id : payment_id , status : status},
                                cache: false,
                                // contentType: false,
                                // processData: false,
                                method: 'POST',
                                type: 'json', // For jQuery < 1.9
                                success: function(data){
                                    console.log(data);
                                }
                            });
                        }
                    },
                }
            });
            
    });  
    </script>
@endsection