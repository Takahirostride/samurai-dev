@extends('layouts.home')
@section('style')
    {{HTML::style('assets/home/css/home.css')}}
@endsection
@section('content')
<div class="mainpage">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li><a class="bg-color" href="#">TOPページ</a></li>
                    <li class="active">お支払い内容</li>
                </ol>   
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">お支払い内容</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 none-padding">
                <div class="col-sm-3 none-padding-left">
                    <i class="fa fa-times-circle" style="color:#e64c75; font-size: 200px;"></i>
                </div>
                <div class="col-sm-9">
                    <div class="col-sm-12">
                        <p style="color:#de2525; font-size: 15px">お支払いが完了できませんでした</p>
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-3" style="padding-left: 0px;">
                            <p>お支払い内容</p>
                        </div>
                        <div class="col-sm-9">
                            <p>{{$hire->deposit_money() }} 円（うち、消費税5.5%を含む）</p>
                        </div>
                        <div class="col-sm-12 none-padding">
                            <hr>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-3" style="padding-left: 0px;">
                            <p>振込み人口座</p>
                        </div>
                        <div class="col-sm-9">
                            <p>{{session('transfereename')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 center-div" style="margin-bottom: 40px; margin-top: 40px;">
                <button style="margin-right :15px; width:15%; background-color: #399a5c" class="btn btn-success btn-style-shadow-green" type="button" onclick="window.location.href='{{URL::route('client.recruitment', [$hire->id] ) }}';">戻る</button>
            </div>
        </div>
    </div>
</div>




@endsection
@section('script')
<!-- {{HTML::script('/assets/home/js/CPToken.js')}} -->
{{HTML::script('https://credit.j-payment.co.jp/gateway/js/CPToken.js')}}
<script>
    var base_url = '{{URL::to('/')}}';
    var dobank = function()
    {
        if($('#transfereename').val() == '')
        {
            alert('振込み人名義を入力してください');
            return false;
        }
        return true;
    }
</script>
<script src="/assets/home/js/pay.js"></script>
@endsection