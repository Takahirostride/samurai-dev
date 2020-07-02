<?php include ('../inc/header.php'); ?>
<div class="mainpage">
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
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-10 mainpage">
                <div class="text-center">
                    <div class="col-sm-4 clientjob-title"><div class="row"><a class="active" href="mypage/clientjob-1.php">依頼・提案・募集</a></div></div>
                    <div class="col-sm-4 clientjob-title"><div class="row"><a href="mypage/clientjob-2.php">マッチング案件</a></div></div>
                    <div class="col-sm-4 clientjob-title"><div class="row"><a href="mypage/clientjob-3.php">終了した案件</a></div></div>
                </div>
                <div class="div-style-grey col-sm-12">
                    <div class="col-sm-4">
                        <h5 >4/4</h5>
                    </div>
                    <div class="col-sm-8">
                        <div class="col-sm-1"></div>
                        <h5 class="col-sm-2">表示年月：</h5>
                        <div class="col-sm-2" >
                            <select class="form-control" aria-invalid="false">
                                <option value="0" selected="selected">すべて</option>
                                <option value="2017">2017年</option>
                                <option value="2018">2018年</option>
                                <option value="2019">2019年</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select class="form-control ">
                                <option value="0" selected="selected">すべて</option>
                                <option value="1">1月</option>
                                <option value="2">2月</option>
                                <option value="3">3月</option>
                                <option value="4">4月</option>
                                <option value="5">5月</option>
                                <option value="6">6月</option>
                                <option value="7">7月</option>
                                <option value="8">8月</option>
                                <option value="9">9月</option>
                                <option value="10">10月</option>
                                <option value="11">11月</option>
                                <option value="12">12月</option>
                            </select>
                        </div>
                        <h5 class="col-sm-2">表示件数：</h5>
                        <div class="col-sm-3">
                            <select class="form-control ">
                                <option value="10" selected="selected">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 clientjob-tab">
                    <div class="row">
                        <ul class="nav nav-tabs tab-1"> 
                            <li class="tab-style-grey  active">
                                <a href="mypage/clientjob-1.php">依頼中</a>
                            </li>                                     
                            <li class="tab-style-grey">
                                <a href="mypage/clientjob-1-2.php">受けた提案</a>
                            </li> 
                            <li class="tab-style-grey">
                                <a href="mypage/clientjob-1-3.php">募集案件</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <table class="table table-bordered table-hover table-myjob full-table-click">
                            <thead>
                                <tr>
                                    <th>日時</th>
                                    <th>タイトル</th>
                                    <th>募集内容</th>
                                    <th>メッセージ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>2018年09月06日</td>
                                    <td class="td-link"><a href="mypage/clientjob-1-4.php">帯広市特定事業所、試験研究施設の新設・増設に対する助成</a></td>
                                    <td class="td-link"><a href="mypage/clientjob-1-5.php">山田太郎（士業1）</a></td>
                                    <td class="td-link"><a href="mypage/clientjob-1-9.php">依頼送信済み</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-8 clientjob-1-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title">
                                <span>依頼内容を入力する</span>
                                <a href="#" class="btn-primary btn btn-style-shadow-green btn-success right-title">メッセージを送る</a>
                            </h4>
                        </div>
                    </div>
                    <div class="w100">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                <tr>
                                    <td rowspan="3" class="div-style-blue2 text-primary tit">
                                        <button type="button"  class="btn-primary w100 ">依頼内容</button>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-sm-12 scroll">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr style="">
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                    <h5 class="text-center col-sm-4">
                                                                        <b >2018年09月06日</b>
                                                                    </h5>
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                                <h5 >テスト
                                                                    :
                                                                </h5>
                                                                <p >test</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                    <h5 class="text-center col-sm-4">
                                                                        <b >2018年09月06日</b>
                                                                    </h5>
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                                <h5 >テスト
                                                                    :
                                                                </h5>
                                                                <p >test</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                    <h5 class="text-center col-sm-4">
                                                                        <b >2018年09月18日</b>
                                                                    </h5>
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                                <h5 >テスト
                                                                    :
                                                                </h5>
                                                                <p >test</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="col-sm-4">
                                                    <hr>
                                                </div>
                                                <h5 class="text-center col-sm-4">2018年09月18日</h5>
                                                <div class="col-sm-4">
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="col-sm-12">
                                                    <label class="control-label box-line-darkgray">
                                                        <img src="assets/images/messagesend.png">
                                                        <text >山田太郎（士業1）</text>
                                                    </label>
                                                </div>
                                                <div class="col-sm-12">
                                                        <label class="control-label box-line-darkgray" >
                                                        <label for="file">
                                                            <span class="glyphicon glyphicon-paperclip" tabindex="0"></span>
                                                        </label>
                                                        <input id="file" type="file" multiple="">
                                                        </label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" rows="3" id="formInput362" placeholder="ここにメッセージを入力してください" aria-invalid="false"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title">
                                <span>依頼した費用</span>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                    <tr>
                                        <td rowspan="3" class="div-style-blue2 text-primary tit">
                                            <button type="button" class="btn-primary cost-content-btn">費用内容</button>
                                            <b>&nbsp;</b>
                                        </td>
                                        <td class="pd0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row cost-div">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">書類代行費用</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">0
                                                                <t>&nbsp;&nbsp;円</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">成功報酬</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">
                                                                <t>（取得助成金・補助金総額の）&nbsp;</t>0
                                                                <t>&nbsp;&nbsp;%</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">着手金</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">50000
                                                                <t>円</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div1">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">報酬支払額</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">50000
                                                                <t>円&nbsp;+&nbsp;（取得助成金・補助金総額の）</t>0
                                                                <t>%</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">その他費用</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">0
                                                                <t>円</t>
                                                                <span>
                                                                    <button class="matching-btn read-more" data-show="matching-cost"  type="button">内訳</button>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div id="matching-cost" class="row ds-none">
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="bold">&nbsp;</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="row">
                                                                        <div class="col-sm-6"><p class="bold">&nbsp;</p></div>
                                                                        <div class="col-sm-6">0 円</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="bold">&nbsp;</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="row">
                                                                        <div class="col-sm-6"><p class="bold">&nbsp;</p></div>
                                                                        <div class="col-sm-6">0 円</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="bold">&nbsp;</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="row">
                                                                        <div class="col-sm-6"><p class="bold">&nbsp;</p></div>
                                                                        <div class="col-sm-6">0 円</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="bold">&nbsp;</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="row">
                                                                        <div class="col-sm-6"><p class="bold">&nbsp;</p></div>
                                                                        <div class="col-sm-6">0 円</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="bold">&nbsp;</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="row">
                                                                        <div class="col-sm-6"><p class="bold">&nbsp;</p></div>
                                                                        <div class="col-sm-6">0 円</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-3">
                                                                    <p class="bold">&nbsp;</p>
                                                                </div>
                                                                <div class="col-sm-9">
                                                                    <div class="row">
                                                                        <div class="col-sm-6"><p class="bold">&nbsp;</p></div>
                                                                        <div class="col-sm-6">0 円</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div1">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">報酬支払総額</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">50000
                                                                <t>円&nbsp;+&nbsp;（取得助成金・補助金総額の）</t>0
                                                                <t>%</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title">
                                <span>提案された費用</span>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                    <tr>
                                        <td rowspan="3" class="div-style-blue2 text-primary">
                                            <button type="button" class="btn-primary cost-content-btn">費用内容</button>
                                            <b>&nbsp;</b>
                                        </td>
                                        <td class="pd0">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="row cost-div">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">書類代行費用</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">0
                                                                <t>&nbsp;&nbsp;円</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">成功報酬</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">
                                                                <t>（取得助成金・補助金総額の）&nbsp;</t>0
                                                                <t>&nbsp;&nbsp;%</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">着手金</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">50000
                                                                <t>円</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div1">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">報酬支払額</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">50000
                                                                <t>円&nbsp;+&nbsp;（取得助成金・補助金総額の）</t>0
                                                                <t>%</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">その他費用</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">0
                                                                <t>円</t>
                                                                <span>
                                                                    <button class="matching-btn" type="button">内訳</button>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row cost-div1">
                                                        <div class="col-sm-3">
                                                            <p class="cost-p">報酬支払総額</p>
                                                        </div>
                                                        <div class="col-sm-9 text-center">
                                                            <p class="cost-p-1">50000
                                                                <t>円&nbsp;+&nbsp;（取得助成金・補助金総額の）</t>0
                                                                <t>%</t>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="pagerow-title">
                                <span>費用を入力する</span>
                                <button type="button" id="btn-open-modal" class="btn-primary btn btn-style-shadow-green btn-success right-title">メッセージを送る</button>
                            </h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover none-over-table table-bordered" >
                                <tbody>
                                    <tr>
                                        <td class="div-style-blue2 text-primary tit" >
                                            <select class="form-control " aria-invalid="false">
                                                <option ng-repeat="savedbudget in savedbudgetarray" value="0" class="ng-binding " selected="selected">登録内容1</option>
                                            </select>
                                            <b>&nbsp;</b>
                                        </td>
                                        <td class="pd0">
                                            <div class="col-sm-12">
                                                <label class="matching-conditions-check">
                                                    <input type="checkbox" >マッチング条件を提案
                                                </label>
                                            </div>
                                            <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5>業務内容</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row" >
                                                        <div class="col-sm-4">
                                                            <label><input class="control-label checkdis" type="checkbox" data-tgdis="document-surrogate-cost" id="checkbox-document-surrogate-cost" aria-invalid="false"> 書類代行費用</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" id="document-surrogate-cost" data-s="s-document-surrogate-cost" class="form-control   sum" placeholder="金額" disabled="disabled" aria-invalid="false" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" >
                                                        <div class="col-sm-4">
                                                            <label><input class="control-label checkdis" type="checkbox" aria-invalid="false" data-tgdis="success-fee" id="checkbox-success-fee"> 成功報酬</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" max="100" id="success-fee" class="form-control" placeholder="金額" disabled="disabled" value="0" aria-invalid="false">
                                                                <span class="form-control-feedback">%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                <div class="col-sm-3">
                                                    <h5>着手金</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <h5>着手金</h5>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" type="number" id="starting-money" name="starting-money" class="form-control sum" data-s="s-starting-money" placeholder="金額" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <h5>その他費用</h5>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other1" data-s="name-other1"  class="form-control set-name" placeholder="費用名" aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-1" data-s="s-other1" id="other-1" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other2" data-s="name-other2"  class="form-control set-name" placeholder="費用名" aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-2" id="other-2" data-s="s-other2" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other3" data-s="name-other3"  class="form-control set-name" placeholder="費用名" aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-3" id="other-3" data-s="s-other3" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other4" data-s="name-other4"  class="form-control set-name" placeholder="費用名"  aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-4" id="other-4" data-s="s-other4" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="name-other5" data-s="name-other5"  class="form-control set-name" placeholder="費用名"  aria-invalid="false">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group has-feedback">
                                                                <input min="0" class="form-control sum" placeholder="金額" aria-invalid="false" name="other-5" id="other-5" data-s="s-other5" value="0">
                                                                <span class="form-control-feedback">円</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p class="cost-p">合計</p>
                                                        </div>
                                                        <div class="col-sm-4">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p class="cost-p-1"><span id="show-total">0</span>
                                                                <t>円</t>
                                                                <input type="hidden" value="0" name="total" id="total">
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 div-style-light-brown">
                                                <div class="col-sm-3">
                                                    <h5>支払総額</h5>
                                                </div>
                                                <div class="col-sm-9 center-div">
                                                    <p class="cost-p-1">
                                                        <span class="showtotal-all" >0</span> 円 + (取得助成金・補助金総額の）&nbsp;
                                                        <span class="show-pencent" >0</span>％
                                                        <input type="hidden" value="0" name="all-total" id="all-total">
                                                        <input type="hidden" value="0" name="pencent" id="pencent">
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb20" >
                        <div class="col-sm-12">
                            <p class="note">・予算目安を送信することで、補助金・助成金取得費用を士業の方に伝えることができます。</p>
                            <p class="note">・郵送費、交付手数料等の実費のみ、その他の費用とすることができます。</p>
                            <p class="note">・最終条件を提示する場合（マッチング成立）は、
                                <label class="matching-conditions-check" style="float: none">
                                    <input type="checkbox" disabled="disabled">マッチング条件を提案
                                </label>にチェックをいれて提案してください。士業の方が、
                                <button type="button" class="btn-primary btn btn-style-shadow-green btn-success">マッチングする</button>&nbsp;&nbsp;&nbsp;をクリックすると、 業務開始されます。
                            </p>
                        </div>
                    </div>
                    <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog box-in">
                          <div class="modal-content box-out">
                            <div class="row div-style-blue3 center-div">
                                <div class="col-sm-12">
                                    <div class="div-left-solid-white"></div>
                                    <p class="p-center-title">依頼費用</p>
                                    <div class="div-right-solid-white"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 box-user-rating max-w300">
                                    <div class="row">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="tb-v-m">
                                                        <input class="control-label" type="checkbox" checked="">
                                                    </th>
                                                    <th class="text-center tb-v-m">
                                                        <img class="w80" src="assets/images/anh-dd.png">
                                                        <button type="button" class="btn-primary btn-follow">フォロー</button>
                                                    </th>
                                                    <th class="font12 col-sm-7">
                                                        <div class="w100">
                                                        <p>士業名：<span >山田太郎（士業1）</span>
                                                        </p>
                                                        </div>
                                                        <div class="w100">
                                                        <p>実績&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：
                                                        </p>
                                                        </div>
                                                        <div class="w100">
                                                        <p>評価&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：<span >7</span>件</p>
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                <table class="table table-w700 none-over-table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="div-style-blue2 text-primary tit">
                                                <button type="button" class="btn-primary cost-content-btn">見積もり内容</button>
                                            </td>
                                            <td class="pd0">
                                                <div class="col-sm-12">
                                                    <label class="matching-conditions-check">
                                                        <input type="checkbox">マッチング条件を提案
                                                    </label>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <h5 class="bold">業務内容</h5>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="bold" >書類代行費用</p>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <p><span id="s-document-surrogate-cost">0</span>円</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            &nbsp;
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="bold">成功報酬</p>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <p><span id="s-success-fee">0</span>%</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 cost-div">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <h5 class="bold">着手金</h5>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <p class="bold">着手金</p>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <p><span id="s-starting-money">0</span>円</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="bold">その他費用</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-4"><p class="bold">内訳</p></div>
                                                                <div class="col-sm-4"><p id="name-other1">&nbsp;</p></div>
                                                                <div class="col-sm-4"><span id="s-other1">0</span>円</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="bold">&nbsp;</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-4"><p class="bold">&nbsp;</p></div>
                                                                <div class="col-sm-4"><p id="name-other2">&nbsp;</p></div>
                                                                <div class="col-sm-4"><span id="s-other2">0</span>円</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="bold">&nbsp;</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-4"><p class="bold">&nbsp;</p></div>
                                                                <div class="col-sm-4"><p id="name-other3">&nbsp;</p></div>
                                                                <div class="col-sm-4"><span id="s-other3">0</span>円</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="bold">&nbsp;</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-4"><p class="bold">&nbsp;</p></div>
                                                                <div class="col-sm-4"><p id="name-other4">&nbsp;</p></div>
                                                                <div class="col-sm-4"><span id="s-other4">0</span>円</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="bold">&nbsp;</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-4"><p class="bold">&nbsp;</p></div>
                                                                <div class="col-sm-4"><p id="name-other5">&nbsp;</p></div>
                                                                <div class="col-sm-4"><span id="s-other5">0</span>円</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <p class="bold">&nbsp;</p>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="row">
                                                                <div class="col-sm-4"><p class="bold">合計</p></div>
                                                                <div class="col-sm-4"><p id="name-total">&nbsp;</p></div>
                                                                <div class="col-sm-4"><span id="total2">0</span>円</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 div-style-light-brown">
                                                    <div class="col-sm-3">
                                                        <h5>支払総額</h5>
                                                    </div>
                                                    <div class="col-sm-9 center-div">
                                                        <p class="cost-p-1">
                                                            <span class="showtotal-all" >0</span> 円 + (取得助成金・補助金総額の）&nbsp;
                                                            <span class="show-pencent" >0</span>％
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            <div class="row mgt-20 mb20">
                                <div class="row text-center ">
                                    <button type="button" class="btn-primary btn btn-style-shadow-green btn-success btn-w150 mgr-15" >提案する</button>
                                        <button type="button" id="close-modal" class="btn btn-style-shadow-grey exit btn-w150">戻る</button>
                                    </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 sidebar-right mt10">
                    <div class="row">
                        <div class="col-sm-12 div-style-white">
                            <label>
                                <input class="control-label" type="checkbox"> チェックした士業に依頼をする
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="tb-v-m">
                                        <input class="control-label" type="checkbox">
                                    </th>
                                    <th class="text-center tb-v-m" >
                                        <img class="w80" src="assets/images/anh-dd.png" class="img-thumbnail">
                                        <button type="button" class="btn-primary btn-follow" >フォロー</button>
                                    </th>
                                    <th class="font20 col-sm-7">
                                        <div class="w100">
                                        <p>士業名：<span >山田太郎（士業1）</span>
                                        </p>
                                        </div>
                                        <div class="w100">
                                        <p>実績&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：
                                        </p>
                                        </div>
                                        <div class="w100">
                                        <p >評価&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;：<span >7</span>件</p>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>

			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".sum").change(function(){
            var total = $("#total");
            var showtotal = $("#showtotal");
            total.val(parseFloat($('#other-1').val()) + parseFloat($('#other-2').val()) + parseFloat($('#other-3').val()) + parseFloat($('#other-4').val()) + parseFloat($('#other-5').val()));
            $("#show-total").text(total.val());
            $('#total2').text(total.val());
            if($("#document-surrogate-cost").attr('disabled') != "disabled"){
                $("#all-total").val(parseFloat(total.val()) + parseFloat($('#document-surrogate-cost').val()) + parseFloat($("#starting-money").val()));
            }else{
                $("#all-total").val(parseFloat(total.val()) + parseFloat($("#starting-money").val()));
            }
            $(".showtotal-all").text($("#all-total").val());
            var s_modal = $(this).attr('data-s');
            $("#"+s_modal).text($(this).val());
        });

        $('#success-fee').change(function(){
            $(".show-pencent").text($("#success-fee").val()); 
            $("#s-success-fee").text($("#success-fee").val()); 
        }) 

        $("#checkbox-success-fee").click(function(){
                if($("#success-fee").attr('disabled') == "disabled"){ 
                    $(".show-pencent").text($("#success-fee").val()); 
                    $("#s-success-fee").text($("#success-fee").val()); 

                }else{
                  $(".show-pencent").text("0");   
                  $("#s-success-fee").text("0");     
                } 
        })

        $("#checkbox-document-surrogate-cost").click(function(){
                var total = $("#total");
                if($("#document-surrogate-cost").attr('disabled') == "disabled"){ 
                   $("#all-total").val(parseFloat(total.val()) + parseFloat($('#document-surrogate-cost').val()) + 
                    parseFloat($("#starting-money").val()));
                }else{
                    $("#all-total").val(parseFloat(total.val()) + parseFloat($("#starting-money").val()));  
                }
                $(".showtotal-all").text($("#all-total").val());    
        })

        $(".set-name").change(function(){
             var s_modal = $(this).attr('data-s');
            $("#"+s_modal).text($(this).val());
        })

        
    })
</script>