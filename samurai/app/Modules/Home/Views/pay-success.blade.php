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
					<li class="active">支払い管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">支払い管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 mainpage">
                <div class="hide_part" id="form_submmit">
	                <div class="row">
	                    <div class="col-sm-12 mgt-20">
	                        <div class="col-sm-12 none-padding ng-scope">
    <h4>お支払い内容</h4>
    <hr>
</div>
<div class="col-sm-12 none-padding ng-scope">
    <div class="col-sm-3 none-padding-left">
        <!-- ngIf: payment.selectedcard --><i class="fa fa-check-circle-o ng-scope" style="color:#399a5c; font-size: 200px;" ng-if="payment.selectedcard"></i><!-- end ngIf: payment.selectedcard -->
        <!-- ngIf: !payment.selectedcard -->
    </div>
    <div class="col-sm-9">
        <div class="col-sm-12">
            <!-- ngIf: payment.selectedcard --><p style="color:#399a5c; font-size: 15px" ng-if="payment.selectedcard" class="ng-scope">お支払いが完了いたしました。</p><!-- end ngIf: payment.selectedcard -->
            <!-- ngIf: !payment.selectedcard -->
            <hr>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-3" style="padding-left: 0px;">
                <p>お支払い内容</p>
            </div>
            <div class="col-sm-9">
                <p><span ng-bind="money.total" class="ng-binding">{{session('money_total')}}</span>円（うち、消費税<span ng-bind="money.consumption_tax_rate" class="ng-binding">8</span>%を含む）</p>
            </div>
            <div class="col-sm-12 none-padding">
                <hr>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-3" style="padding-left: 0px;">
                <p>ご利用カード番号</p>
            </div>
            <div class="col-sm-9">
                <p class="ng-binding">末尾番号&nbsp;&nbsp;&nbsp;4667</p>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-9 col-sm-offset-3 center-div ng-scope" style="margin-bottom: 40px; margin-top: 40px;">
    <button style="margin-right :15px; width:15%; background-color: #399a5c" class="btn btn-success btn-style-shadow-green ng-binding" type="button" onclick="window.location.href='{{session('pay_back_link')}}';">支払い管理へ</button>
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

@endsection