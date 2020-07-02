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
                            <select class="form-control"aria-invalid="false">
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
                            <select class="form-control "  aria-invalid="false" style="">
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
                            <li class="tab-style-grey active">
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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="div-suggestion-policy">
                            <div class="form-group col-sm-10 mb0">
                                <label class="lbangularsl" for="">施策名：</label>
                                <div class="angularsl pull-left">
                                    <select class="mgl-15" name="filteryear">
                                        <option value="" selected="selected">すべて</option>
                                        <option value="葛飾区三年以内既卒者等採用定着コース奨励金">葛飾区三年以内既卒者等採用定着コース奨励金</option>
                                        <option value="横浜市 IoT 導入スタートアップ補助金">横浜市 IoT 導入スタートアップ補助金</option>
                                        <option value="新事業育成資金(新企業育成貸付)">新事業育成資金(新企業育成貸付)</option>
                                        <option value="中小企業海外展開チャレンジ（終了">中小企業海外展開チャレンジ（終了</option>
                                        <option value="トライアルユース補助事業">トライアルユース補助事業</option>
                                        <option value="産業立地資金（本社機能・支社機能・ホテル）">産業立地資金（本社機能・支社機能・ホテル）</option>
                                        <option value="平成３０年度創業セミナー">平成３０年度創業セミナー</option>
                                        <option value="横浜市中小企業融資制度">横浜市中小企業融資制度</option>
                                        <option value="山形県元気な６次産業化ステップアップ支援事業（スモールビジネス創出支援事業）２次募集">山形県元気な６次産業化ステップアップ支援事業（スモールビジネス創出支援事業）２次募集</option>
                                    </select>
                                <div class="onclselect"></div><div class="showoption">
                                        <div data-value="" class="select-d">すべて</div>
                                        <div data-value="葛飾区三年以内既卒者等採用定着コース奨励金">葛飾区三年以内既卒者等採用定着コース奨励金</div>
                                        <div data-value="横浜市 IoT 導入スタートアップ補助金">横浜市 IoT 導入スタートアップ補助金</div>
                                        <div data-value="新事業育成資金(新企業育成貸付)">新事業育成資金(新企業育成貸付)</div>
                                        <div data-value="中小企業海外展開チャレンジ（終了">中小企業海外展開チャレンジ（終了</div>
                                        <div data-value="トライアルユース補助事業">トライアルユース補助事業</div>
                                        <div data-value="産業立地資金（本社機能・支社機能・ホテル）">産業立地資金（本社機能・支社機能・ホテル）</div>
                                        <div data-value="平成３０年度創業セミナー">平成３０年度創業セミナー</div>
                                        <div data-value="横浜市中小企業融資制度">横浜市中小企業融資制度</div>
                                        <div data-value="山形県元気な６次産業化ステップアップ支援事業（スモールビジネス創出支援事業）２次募集">山形県元気な６次産業化ステップアップ支援事業（スモールビジネス創出支援事業）２次募集</div>
                                    </div></div>
                            </div>
                            </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <table class="table table-bordered table-hover table-myjob full-table-click">
                            <thead>
                                <tr>
                                    <th>日時</th>
                                    <th>タイトル</th>
                                    <th>士業名</th>
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
                <div class="row">
                    <nav class="text-center" aria-label="pagination">
                        <ul class="pagination">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1">最初</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>

                            <li class="page-item">
                              <a class="page-link" href="#">最後</a>
                            </li>
                        </ul>
                    </nav>
                </div>

			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>