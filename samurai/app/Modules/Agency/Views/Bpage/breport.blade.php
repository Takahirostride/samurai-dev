@extends('layouts.home')
@section('style')
	<link rel="stylesheet" href="/assets/agency/css/b_ask.css">
@endsection
@section('content')
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@includeIf('partials.breadcrumb', ['title' => '提案する'])
			</div>
		</div> <!-- end .row -->
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">違反者として申告する</h1>
			</div>
		</div> <!-- end .row -->
		{{ Form::open(['url' => route('agency.breport',['policy_id'=>request()->policy_id, 'report_id'=>request()->report_id]), 'method' => 'POST', 'id'=>'formID', 'enctype'=>'multipart/form-data']) }}
		<div class="row">
		    <div class="col-sm-offset-2 col-sm-8">
		        <div class="div-style-yellow-1">
		            <div class="pd40-20">
		                <p><b>利用規約に違反の恐れがある場合は「違反申告」にご協力をお願いします。</br>
		                申告内容は、SAMURAI事業部において必ず確認し、利用規約に照らして個別に慎重に判断を行い、必要に応じて適切な処置を実施致します。</br>
		                依頼をしたユーザーにはSAMURAI事業部が利用規約違反と判断をするまで、違反申告があったことは告知されません。場合により調査にお時間が掛かる場合もありますが、必ずチェックを実施させて頂いております。</br>
		                SAMURAI事業部が健全で、快適なサービスであり続けるよう、皆様のご協力に感謝いたします。</br>
		                違反するかどうかの判断や結果、違反理由への回答や返信は行なっておりませんのでご了承ください。</b></p>
		            </div>                         
		        </div>                    
		        <h3 class="page-title">違反者報告をする</h3>
		        <div class="pd-30">
		            <label><input class="control-label" type="radio" value="0" name="reportway">        直接取引や勧誘     </label>
		            <br>
		            <label><input class="control-label" type="radio" value="1" name="reportway">        助成金・補助金の偽装投稿・虚偽申請の恐れ    </label>
		            <br>
		            <label><input class="control-label" type="radio" value="2" name="reportway">        記載内容と明らかに異なる内容、金額の提案</label>
		            <br>
		            <label><input class="control-label" type="radio" value="3" name="reportway">        その他の利用規約違反の恐れ        </label>                  
		        </div>
		        <div class="">
		            <table class="table table-hover none-over-table table-bordered" style="margin-bottom: 10px; border: 1px solid #d6d6d6;min-height:200px"> 
		                <tbody> 
		                    <tr> 
		                        <td rowspan="1" class="div-style-blue2 text-primary" style="font-size: 12px;width: 20%">
		                            <button type="button" class="btn-primary" style="width: 100%;margin-bottom:10px;">違反内容</button>
		                        </td>                                     
		                        <td style="font-size: 12px">
		                            <textarea class="form-control" rows="7" name="message" placeholder="ここに文字を入力してください"></textarea>
		                        </td>
		                    </tr>                                 
		                </tbody>
		            </table>
		        </div>
		        <div class="row text-center mgbt-50 mgt-30">
		            <button type="submit" class="btn btn-success  btn-style-shadow-green" style="margin-right:20px;width:150px;">申告する</button>
		            <a href="{{route('agency.RequestDetails',['policy_id'=>request()->policy_id, 'user_id'=>request()->report_id])}}" class="btn btn-style-shadow-grey" style="width:150px;">戻る</a>
		        </div>
		    </div>
		</div>
		{{ Form::close() }}
	</div> <!-- end .container -->
</div> <!-- end .mainpage -->

@endsection

