@extends('layouts.home')

@section('style')
	{{HTML::style('assets/common/css/recruit_chat.css')}}
@endsection
@section('content')
<div class="mainpage chat-page-area">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">仕事管理</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">仕事管理</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 mainpage chat-page">
				<div class="row">
					<div class="col-sm-3">
						<div class="diconleft">
							<ul class="diconleft-ul">
								<li><a title="マイページトップ" href="{{URL::route('agency.home')}}"><i class="fa fa-home"></i></a></li>
								<li><a title="プロフィール管理" href="{{URL::route('agency.profile')}}"><i class="fa fa-id-card"></i></a></li>
								<li><a title="会員情報管理" href="{{URL::route('agency.memberinfo')}}"><i class="fa fa-cog"></i></a></li>
								<li><a title="仕事管理" href="{{URL::route('agency.recruitment')}}"><i class="fa fa-tasks"></i></a></li>
								<li><a title="お気に入り" href="{{URL::route('agency.checklist')}}"><i class="fa fa-star-o"></i></a></li>
								<li><a title="各種認証管理" href="{{URL::route('agency.authentication')}}"><i class="fa fa-check-square-o"></i></a></li>
								<li><a title="支払い管理" href="{{URL::route('agency.payment')}}"><i class="fa fa-money"></i></a></li>
								<li><a title="アフィリエイト管理" href="{{URL::route('agency.affiliate')}}"><i class="fa fa-group"></i></a></li>
							</ul>
						</div>
						<div class="dleft-list-user">
							<div class="dleft-item">
								<a href="#"></a>
								<div class="dleft-avatar">
									<img src="/assets/common/images/client.png" alt="">
								</div>
								<div class="dleft-uinfo">
									<span class="badge">3</span>
									<p class="dleft-uname">name</p>
									<p class="dleft-pname">案件名：ものづくり</p>
									<p class="dleft-price">提案額：300,000円</p>
								</div>
							</div> <!-- end .dleft-item -->
							<div class="dleft-item active">
								<a href="#"></a>
								<div class="dleft-avatar">
									<img src="/assets/common/images/client.png" alt="">
								</div>
								<div class="dleft-uinfo">
									<span class="badge">3</span>
									<p class="dleft-uname">name</p>
									<p class="dleft-pname">案件名：ものづくり</p>
									<p class="dleft-price">提案額：300,000円</p>
								</div>
							</div> <!-- end .dleft-item -->
						</div> <!-- end .dleft-list-user -->
					</div> <!-- end .col-sm-3 -->
					<div class="col-sm-9">
						<div class="detail-hire">
							<div class="djob-navbar">
								<a href="#">進んでいる案件</a>
								<a href="#" class="active">依頼が来た案件 <span class="badge">3</span></a>
								<a href="#">提案した案件</a>
								<a href="#">終了した案件</a>
							</div>
							<div class="djob-info">
								<p>案件名：ものづくり補助金</p>
								<p>士業名：Hashimoto Ryuji </p>
							</div>
							<div class="dpolicy-item-list">
								<div class="dpolicy-item">
									<div class="dpleft">
										<div class="dpleft-top">
											<div class="dp-top-image">
												<img src="/assets/photo/佐賀県.jpg" alt="">
											</div> <!-- end .dp-top-image -->
											<div class="dp-top-meta">
												<h2 class="dp-title"><a href="#">ものづくり・商業・サービス補助金</a></h2>
												<div class="dmeta-content">
													<p>発行機関：厚生労働省</p>
													<p>対象地域：全国</p>
													<p>募集時期：随時</p>
												</div>
												<div class="dmeta-tags">
													<a href="#" class="dptag">タグ</a>
													<a href="#" class="dptag">タグ</a>
													<a href="#" class="dptag">タグ</a>
													<a href="#" class="dptag">タグ</a>
													<a href="#" class="dptag">タグ</a>
												</div> <!-- end .dmeta-tags -->
											</div> <!-- end .dp-top-meta -->
										</div> <!-- end .dpleft-top -->
										<div class="dpleft-bottom">
											<div class="dp-sp-content">
												<span class="rounder-sp"><span></span>支援内容</span>
												<p>１．企業間データ活用型 補助上限額:1,000万円/者※（補助率 2/3）複数の中小企業・小規模事業者が、事業者間でデータ・情報を共有し、・・・</p>
											</div>
											<div class="dp-sp-scale">
												<span class="rounder-sp"><span></span>支援規模</span>
												<p>１．企業間データ活用型 補助上限額:1,000万円/者※（補助率 2/3）複数の中小企業・小規模事業者が、事業者間でデータ・情報を共有し、・・・</p>
											</div>
											<div class="dp-sp-price">
												<span class="rounder-sp"><span></span>施策種別</span>
												<p class="dsp-price">取得可能金額：100万円</p>
											</div>
										</div> <!-- end .dpleft-bottom -->
									</div> <!-- end .dpleft -->
									<div class="dpright">
										<div class="dagency-info">
											<img class="dagency-image" src="/assets/photo/2b44928ae11fb9384c4cf38708677c48.jpg" alt="">
												<div class="ditemav-info">
													<p>事業者名</p>
													<p>username</p>
													<div class="clearfix"></div>
													{!! Button::getRatingStar(0, 4.3) !!}

													
												</div>
												<p class="dself-intro">創業14周年を迎え、日本国内で培ったノウハウを活かした海外での事業展開を加速させていきたいと考えております。</p>
										</div> <!-- end .agency-info -->
										<div class="total-client-right">
											<img src="/assets/photo/clienticon.png" alt="">
											<p><a href="#">他12社</a></p>
										</div>
									</div><!-- end .dpright -->
								</div> <!-- end .dpolicy-item -->
								
							</div> <!-- end .dpolicy-item-list -->
							<h4>予算と納期</h4>
							<table class="table table-date-policy table-bordered">
								<tbody>
									<tr>
										<td colspan="2" class="text-center">予定納期 ：2018年10月31日</td>
									</tr>
									<tr>
										<td class="text-center">
											<span>報酬金額 ： 335,283円+税 </span>
											<button type="button" class="btn btn-warning pull-right big-button">請求する</button>
										</td>
										<td rowspan="2" class="text-center" style="vertical-align: middle"><button type="button" class="btn btn-success">終了報告・キャンセル</button></td>
									</tr>
									<tr>
										<td class="text-center">
											<span>後払い金額 ： 335,283円+税</span>
											<button type="button" class="btn btn-warning pull-right big-button">請求する</button>
										</td>
									</tr>
								</tbody>
							</table>
							<h2 class="page-title">タスク進歩状況</h2>
							<div class="table-responsive new-task-table">
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td></td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/agency.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/agencygrey.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/clientgrey.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/clientgrey.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/client.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/country.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/countrygrey.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/countrygrey.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/countrygrey.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/countrygrey.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/country.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/country.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/country.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/country.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/country.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/country.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/country.png" alt=""></a>
											</td>
											<td>
												<span></span><a href="#"><img src="/assets/common/images/country.png" alt=""></a>
											</td>
										</tr>
										<tr>
											<td>対応者</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
										</tr>
										<tr>
											<td>対応者</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
										</tr>
										<tr>
											<td>対応者</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>agency</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
											<td>対応者</td>
										</tr>
									</tbody>
								</table>
							</div> <!-- end table -->
							<h2 class="page-title">書類アップロード状況</h2>
							<table class="table table-bordered table-hover table-tallpro">
						    <thead>
							    <tr>
							        <th>ファイル名</th>
							        <th>更新日</th>
							        <th>返信期日</th>
							        <th>更新ファイル名</th>
							        <th>更新者</th>
							        <th>更新ファイル</th>
							    </tr>
						    </thead>
						    <tbody>
							    <tr>
							        <td class="text-center">
							        	<p class="mgt-20"></p>
							        											<button type="button" data-id="77" class="shadowbuttonprimary btndisabled btn btn-primary complete_btn complete_btn_77">未完了</button>
									    							        </td>
							        <td colspan="4" id="tf-77">  アップされたファイルはありません。  
																			<table class="table table-hover table-bordered" style="margin-bottom:0">
											<tbody><tr>
												<td width="110">2018-01-01</td>
												<td width="110">2018-10-22</td>
												<td style="word-break:break-word;"><a href="http://samurai-match.develop/api/download-file/assetsAND&amp;work_set_attachAND&amp;2018_10_22AND&amp;6757634873f3e69aafdeaf43d0f63322.jpg/%E4%BD%90%E8%B3%80%E7%9C%8C.jpg" target="_blank">佐賀県.jpg</a></td>
												<td width="60"> <img src="http://samurai-match.develop/assets/common/images/agency.png" class="imgcircle" alt="">  </td>
											</tr>
										</tbody></table>
																			<table class="table table-hover table-bordered" style="margin-bottom:0">
											<tbody><tr>
												<td width="110">2018-02-01</td>
												<td width="110">2018-10-22</td>
												<td style="word-break:break-word;"><a href="http://samurai-match.develop/api/download-file/assetsAND&amp;work_set_attachAND&amp;2018_10_22AND&amp;fd948b67631c17505185a5c4af06b50b.jpg/%E7%BE%A4%E9%A6%AC%E7%9C%8C.jpg" target="_blank">群馬県.jpg</a></td>
												<td width="60"> <img src="http://samurai-match.develop/assets/common/images/agency.png" class="imgcircle" alt="">  </td>
											</tr>
										</tbody></table>
																        </td>

							        <td class="tb-77">
							        								        	<form method="POST" action="http://samurai-match.develop/agency/mypage/jobs/matching-case/task-view/50" accept-charset="UTF-8" class="form-inline" id="uploadf-77" enctype="multipart/form-data"><input name="_token" type="hidden" value="cr1mno6377mXnzLLkyzWBmlMzRVmUBiXunquQWH1">
							        		<input type="hidden" name="hire_id" value="50">
							        		<input type="hidden" name="work_set_id" value="77">
							        		<p class="text-center">提出期限</p>
							        		<div class="text-center">
								        		<div class="form-group">
								        			<select class="nopdsl" name="day"><option value="0" selected="selected">1</option><option value="1">2</option><option value="2">3</option><option value="3">4</option><option value="4">5</option><option value="5">6</option><option value="6">7</option><option value="7">8</option><option value="8">9</option><option value="9">10</option><option value="10">11</option><option value="11">12</option><option value="12">13</option><option value="13">14</option><option value="14">15</option><option value="15">16</option><option value="16">17</option><option value="17">18</option><option value="18">19</option><option value="19">20</option><option value="20">21</option><option value="21">22</option><option value="22">23</option><option value="23">24</option><option value="24">25</option><option value="25">26</option><option value="26">27</option><option value="27">28</option><option value="28">29</option><option value="29">30</option><option value="30">31</option></select>
													<label for="">月</label>
													
								        		</div>
								        		<div class="form-group">
								        			<select class="nopdsl" name="month"><option value="0" selected="selected">1</option><option value="1">2</option><option value="2">3</option><option value="3">4</option><option value="4">5</option><option value="5">6</option><option value="6">7</option><option value="7">8</option><option value="8">9</option><option value="9">10</option><option value="10">11</option><option value="11">12</option></select>
													<label for="">日</label>
								        		</div>
								        	</div>
								        	<div class="inputfilehide">
								        		<input type="file" name="image" id="file-77">
								        		<span class="glyphicon glyphicon-open-file"></span>
								        	</div>
								        	<p class="text-center">
								        		<button type="button" id="btn-upload-77" onclick="uploadForm(77);" class="shadowbuttonprimary btn btn-primary">更新する</button>
								        	</p>
								        	
							        	</form>
																	        </td>
							    </tr>

						    </tbody>
						</table>
							<div class="ddetail-msg dmessage-list">
								<ul>
									<li style="width:100%"><div class="msj macro"><div class="avatar"><img class="img-circle" style="width:100%;" src="https://lh6.googleusercontent.com/-lr2nyjhhjXw/AAAAAAAAAAI/AAAAAAAARmE/MdtfUmC0M4s/photo.jpg?sz=48"></div><div class="text text-l"><p>asd</p><p><small>4:12 PM</small></p></div></div></li>
									<li style="width:100%"><div class="msj-rta macro"><div class="avatar"><img class="img-circle" style="width:100%;" src="https://lh6.googleusercontent.com/-lr2nyjhhjXw/AAAAAAAAAAI/AAAAAAAARmE/MdtfUmC0M4s/photo.jpg?sz=48"></div><div class="text text-l"><p>asd</p><p><small>4:12 PM</small></p></div></div></li>
								</ul>
								<div class="bottom-input-msg">
									<div class="msg-input">
										<textarea class="form-control mytext" name="" id="" cols="30" rows="3"></textarea>   

					                </div>
					                <div class="input-msg-area">
					                    <span class="glyphicon glyphicon-share-alt"></span>
					                </div>
								</div>
							</div>
						</div> <!-- end .detail-hire -->
					</div> <!-- end col-sm-9 -->
				</div>	<!-- end .row -->
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
	{{HTML::script('assets/common/js/recruit_chat.js')}}
@endsection
