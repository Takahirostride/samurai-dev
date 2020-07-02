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
			<div class="col-sm-3 sidebar-left">
                <p>金額</p>
				<p>支払方法</p>
			</div>
			<div class="col-sm-9 mainpage">
                <div class="hide_part" id="form_submmit">
	                <form method="post" action="">
	                <div class="row">
	                    <div class="col-sm-12 mgt-20">
	                        <p>{{$hire->client_pay}}円（うち、消費税5.5%を含む）</p>
	                        <input type="hidden" name="client_pay" id="client_pay" value="{{$hire->client_pay}}">
	                        <input type="hidden" name="storenumber" id="storenumber" value="{{env('PAYMENT_STORE_ID')}}">
	                        <input type="hidden" name="user_id" id="user_id" value="{{session('user_id')}}">
	                        <p class="color-0f7cc9 bold font14"><label><input type="radio" id="option2" checked="checked" name="option"> 銀行振込</label></p>
	                        <div id="pay22">
	                        <div class="col-sm-12">
	                            <p>入金の確認までに１営業日程度いただきます。</p>
	                            <p>お急ぎの場合は、クレジットカードをご利用ください</p>
	                        </div>
	                        <div class="col-sm-12">
	                            <div class="col-sm-4">
	                                <p>振込先をお選びください：</p>
	                            </div>
	                            <div class="btn-group col-sm-6">
	                                <div class="col-sm-12">
	                                    <div class="angularsl" id="bank_info1">
	                                        <select class="form-control form-select" name="bank_info">
	                                            @foreach ($bank_info as $value)
	                                            <option value="{{$value->id}}">{{$value->bank_name}}</option>
	                                            @endforeach
	                                        </select>
	                                    </div>
	                                </div>
	                                <div class="col-sm-12">
	                                    <p>※振込先口座番号は、完了画面で表示されます</p>
	                                </div>
	                            </div>
	                            <div class="col-sm-4">
	                                <p>振込み人名義（全角カナ）：</p>
	                            </div>
	                            <div class="btn-group col-sm-6">
	                                <div class="col-sm-12">
	                                    <input type="text" name="transfereename" id="transfereename" class="form-control" aria-invalid="false">
	                                </div>
	                                <div class="col-sm-12">
	                                    <p>※ご自身の口座名義をご入力ください<br>（法人名義の口座からお振込みの場合は、法人名義をご入力ください）</p>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-sm-12 mb20 text-center">
	                            <a href="{{URL::route('client.recruitment', [$hire->id] ) }}" class="btn btn-default btn-style-grey w120px mgr-15">戻る</a>
	                            <button type="submit" name="submit" onclick="return dobank()" class="btn btn-danger btn-style-shadow-red w120px">完了する</button>
	                        </div>
	                    </div>
	                    </div>
	                </div>
	                </form>
                </div>
                <div class="hide_part" id="payfinished">
                	<div class="col-sm-12 none-padding">
						    <h4>お支払い内容</h4>
						    <hr>
						</div>
						<div class="col-sm-12 none-padding">
						    <div class="col-sm-3 none-padding-left" id="s2_selectedcard">
						    </div>
						    <div class="col-sm-9">
						        <div class="col-sm-12" id="s_selectedcard">
						            <hr>
						        </div>
						        <div class="col-sm-12">
						            <div class="col-sm-3" style="padding-left: 0px;">
						                <p>お支払い内容</p>
						            </div>
						            <div class="col-sm-9">
						                <p><span ng-bind="money.total">{{$hire->client_pay}}</span>円（うち、消費税<span ng-bind="money.consumption_tax_rate"></span>%を含む）</p>
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
						                <p>末尾番号&nbsp;&nbsp;&nbsp;<span class="v_cardnumber"></span></p>
						            </div>
						        </div>
						    </div>
						</div>
						<div class="col-sm-12 center-div" style="margin-bottom: 40px; margin-top: 40px;">
						    <a style="margin-right :15px; background-color: #399a5c" class="btn btn-success btn-style-shadow-green" href="{{URL::route('client.recruitment', [$hire->id] ) }}" >戻る</a>
						</div>
                </div>
                <div class="hide_part" id="payfailed">
                	<div class="col-sm-12 none-padding">
						    <h4>お支払い内容</h4>
						    <hr>
						</div>
						<div class="col-sm-12 none-padding">
						    <div class="col-sm-3 none-padding-left"  id="s2_selectedcard">
						        <i class="fa fa-times-circle" style="color:#e64c75; font-size: 200px;"></i>
						    </div>
						    <div class="col-sm-9">
						        <div class="col-sm-12" id="s_selectedcard">
						            <p style="color:#de2525; font-size: 15px">お支払いが完了できませんでした</p>
						            <hr>
						        </div>
						        <div class="col-sm-12">
						            <div class="col-sm-3" style="padding-left: 0px;">
						                <p>お支払い内容</p>
						            </div>
						            <div class="col-sm-9">
						                <p><span ng-bind="money.total">{{$hire->client_pay}}</span>円（うち、消費税<span ng-bind="money.consumption_tax_rate"></span>%を含む）</p>
						            </div>
						            <div class="col-sm-12 none-padding">
						                <hr>
						            </div>
						        </div>
						        <div ng-if="payment.selectedcard" class="col-sm-12">
						            <div class="col-sm-3" style="padding-left: 0px;">
						                <p>ご利用カード番号</p>
						            </div>
						            <div class="col-sm-9">
						                <p>末尾番号&nbsp;&nbsp;&nbsp;<span class="v_cardnumber"></span></p>
						            </div>
						        </div>
						        <div ng-if="!payment.selectedcard" class="col-sm-12">
						            <div class="col-sm-3" style="padding-left: 0px;">
						                <p>振込み人口座</p>
						            </div>
						            <div class="col-sm-9">
						                <p><span class="v_transfereename"></span></p>
						            </div>
						        </div>
						    </div>
						</div>
						<div class="col-sm-12 center-div" style="margin-bottom: 40px; margin-top: 40px;">
						    <button type="button" style="margin-right :15px; width:15%; " class="btn btn-default btn-style-shadow-grey" onclick="window.location.href='{{URL::route('client.recruitment', [$hire->id] ) }}';" >戻る</button>
						</div>
                </div>
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