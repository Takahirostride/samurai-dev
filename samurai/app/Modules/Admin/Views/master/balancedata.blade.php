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
<div>
    <div class="content">
        <div class="inner-content">
            <div class="inner-container">
                <div class="row">
                    <div class="col-md-3 pull-left">
                        <div class="sidebar-left">
                            <ul>
                                <!-- <li><a href="{{URL::to('/admin/master/balancesale')}}">売上管理</a></li> -->
                                <li><a href="{{URL::to('/admin/master/balancedepwith')}}">入出金管理</a></li>
                                <li><a href="{{URL::to('/admin/master/balancepayplan')}}">支払予定管理</a></li>
                                <li class="active"><a href="{{URL::to('/admin/master/balancedata')}}">データ総括</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9 pull-right">
                        <div class="site-content">
                            <div class="section-1">
                                <div class="success-msg">
                                    <span>データ総括データを出力しました。</span>
                                </div>
                            </div>

                            <div class="section-2 col-md-12">
                                <form class="form-horizontal" id="search_data_form">
                                    <div class="row">
                                        <div class="col-md-1" style="width:5%;"></div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-sm-3" style="padding-right:0px;">
                                                    {{Form::number('from_year','', ['class'=>'form-control', 'min'=>'2018', 'max'=>'2100', 'onchange'=>'search()'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('from_month','', ['class'=>'form-control', 'min'=>'1', 'max'=>'12', 'onchange'=>'search()'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('from_day','', ['class'=>'form-control', 'min'=>'1', 'max'=>'31', 'onchange'=>'search()'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-sm-3" style="padding-right:0px;">
                                                    {{Form::number('to_year','', ['class'=>'form-control', 'min'=>'2018', 'max'=>'2100', 'onchange'=>'search()'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">年</p>
                                                <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('to_month','', ['class'=>'form-control', 'min'=>'1', 'max'=>'12', 'onchange'=>'search()'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">月</p>
                                                <div class="col-sm-2" style="padding-left:0px;padding-right:0px;">
                                                    {{Form::number('to_day','', ['class'=>'form-control', 'min'=>'1', 'max'=>'31', 'onchange'=>'search()'])}}
                                                </div>
                                                <p class="col-sm-1" style="padding-right:0px;">日</p>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-7">
                                        <form class="form-horizontal ng-pristine ng-valid">
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">全ステータス統計：</p>
                                            </div>
                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">マッチング：</p>
                                            </div>
                                            <div class="add-container" style="margin-left:0px;margin-right:0px;">
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">マッチング成立件数</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('hire_accept_count',$data['hire_accept_count'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">件</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">着手金：</p>
                                            </div>
                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">着手金件数</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('deposit_count',$data['deposit_count'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">件</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">着手金合計金額</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('deposit_amount',$data['deposit_amount'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">円</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">未入金金額合計</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('deposit_nonpay_amount',$data['deposit_nonpay_amount'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">円</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">入金済み金額合計</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('deposit_payed_amount',$data['deposit_payed_amount'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">円</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">入金率</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('deposit_pay_rate',$data['deposit_pay_rate'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">成功報酬：</p>
                                            </div>
                                            <div class="add-container" style="margin-left:0px;margin-right:0px;">
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">助成金・補助金取得件数</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('subsidy_count',$data['subsidy_count'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">件</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">助成金・補助金取得金額</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('subsidy_amount',$data['subsidy_amount'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">円</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">未入金金額合計</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('subsidy_nonpay_amount',$data['subsidy_nonpay_amount'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">円</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">入金済み金額合計</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('subsidy_payed_amount',$data['subsidy_payed_amount'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">円</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">入金率</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('subsidy_pay_rate',$data['subsidy_pay_rate'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">無料会員：</p>
                                            </div>
                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">無料会員件数</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('freeuser_count',$data['freeuser_count'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">件</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">有料会員：</p>
                                            </div>
                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">有料会員件数</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('payuser_count',$data['payuser_count'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">件</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">有料会員費合計金額</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('payuser_fee_amount',$data['payuser_fee_amount'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">円</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">有料オプション：</p>
                                            </div>
                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">有料オプション利用件数</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('payoption_count',$data['payoption_count'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">件</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">有料オプション費合計金額</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('payoption_amount',$data['payoption_amount'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">円</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-top:20px;">
                                                <p class="col-sm-3">仕事提携広告：</p>
                                            </div>
                                            <div class="add-container" style "margin-left:0px;margin-right:0px;"="">
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">仕事提携広告利用件数</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('advert_use_count',$data['advert_use_count'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">件</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4" style="background:#fff;">
                                                        <div class="gridcell-left">
                                                            <p style="font-size:14px;">仕事提携広告費合計金額</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
                                                        <div class="gridcell-right" style="height:40px;padding-right:15px;">
                                                            <div class="col-md-12" style="padding-left:15px;">
                                                                <div class="form-group has-feedback" style="margin-bottom:0px;">
                                                                    {{Form::number('advert_use_amount',$data['advert_use_amount'], ['class'=>'form-control','readonly'=>'true'])}}
                                                                    <span class="form-control-feedback">円</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
        function search(){
            var from_year = $('input[name="from_year"]').val();
            var from_month = $('input[name="from_month"]').val();
            var from_day = $('input[name="from_day"]').val();
            var to_year = $('input[name="to_year"]').val();
            var to_month = $('input[name="to_month"]').val();
            var to_day = $('input[name="to_day"]').val();
            $.ajax({
                url: '/admin/master/ajaxbalancedata?from_year='+from_year+'&from_month='+from_month+'&from_day='+from_day+'&to_year='+to_year+'&to_month='+to_month+'&to_day='+to_day,
                dataType: 'JSON',
                success: function(json) {
                    // console.log(json.advert_use_amount);
                    $('input[name="hire_accept_count"]').val(json.hire_accept_count);
                    $('input[name="deposit_count"]').val(json.deposit_count);
                    $('input[name="deposit_amount"]').val(json.deposit_amount);
                    $('input[name="deposit_nonpay_amount"]').val(json.deposit_nonpay_amount);
                    $('input[name="deposit_payed_amount"]').val(json.deposit_payed_amount);
                    $('input[name="deposit_pay_rate"]').val(json.deposit_pay_rate);
                    $('input[name="subsidy_count"]').val(json.subsidy_count);
                    $('input[name="subsidy_amount"]').val(json.subsidy_amount);
                    $('input[name="subsidy_nonpay_amount"]').val(json.subsidy_nonpay_amount);
                    $('input[name="subsidy_payed_amount"]').val(json.subsidy_payed_amount);
                    $('input[name="subsidy_pay_rate"]').val(json.subsidy_pay_rate);
                    $('input[name="freeuser_count"]').val(json.freeuser_count);
                    $('input[name="payuser_count"]').val(json.payuser_count);
                    $('input[name="payuser_fee_amount"]').val(json.payuser_fee_amount);
                    $('input[name="payoption_count"]').val(json.payoption_count);
                    $('input[name="payoption_amount"]').val(json.payoption_amount);
                    $('input[name="advert_use_count"]').val(json.advert_use_count);
                    $('input[name="advert_use_amount"]').val(json.advert_use_amount);
                }
            });
        }
    </script>
@endsection