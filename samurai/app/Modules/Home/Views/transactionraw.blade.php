@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/home/css/transactionraw.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '特定商取引法に基づく表示'])
				<h1 class="page-title">特定商取引法に基づく表示</h1>
				<div class="clearfix"></div>
				<table class="table table-bordered samurai-table mgt-30"> 
	                <tbody> 
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>販売業者</b></td> 
	                        <td>
	                            株式会社グランドツー
	                        </td> 
	                    </tr>
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>代表者</b></td> 
	                        <td>
	                            出口グラウシオ
	                        </td> 
	                    </tr>
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>サイト</b></td> 
	                        <td>
	                            SAMURAI（サムライ）<br>
	                            <a>http://samurai-match.jp</a>
	                        </td> 
	                    </tr>
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>所在地</b></td> 
	                        <td>
	                            〒150-6006<br>
	                            東京都渋谷区南平台3-13 新堀ビル3F
	                        </td> 
	                    </tr>
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>商品の名称</b></td> 
	                        <td>
	                            サービス利用料課金
	                        </td> 
	                    </tr>
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>販売価格</b></td> 
	                        <td>
	                            料金表説明ページをご覧下さい
	                        </td> 
	                    </tr>
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>連絡先</b></td> 
	                        <td>
	                            <a>info@samurai-match.jp</a>
	                        </td> 
	                    </tr>
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>支払方法と支払期限</b></td> 
	                        <td>
	                            クレジットカード(VISA/MASTER/JCB/AMEX/Diners)・銀行振込<br><br>
								※請求書払いは利用審査があります<br>
								※支払期限につきましては取引によって異なります
	                        </td> 
	                    </tr>
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>引渡し時期</b></td> 
	                        <td>
	                            即時
	                        </td> 
	                    </tr>
	                    <tr> 
	                        <td class="div-style-blue2 text-primary"><b>返品・交換について</b></td> 
	                        <td>
	                            確定後の取引は原則として返品・交換は不可能です
	                        </td> 
	                    </tr>
	                </tbody> 
        </table>
			</div> <!-- .col-sm-12 -->
		</div><!-- .row -->
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->
<div class="clearfix"></div>
@endsection
@section('script')
	<script src="/assets/home/js/transactionraw.js"></script>
@endsection