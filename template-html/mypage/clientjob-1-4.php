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
                                    <td class="td-link"><a href="mypage/clientjob-1-6.php">依頼送信済み</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-8 clientjob-1-4">
                    <div class="row mb20">
                        <p class=" tit1">帯広市特定事業所、試験研究施設の新設・増設に対する助成</p>
                        <p class=" tit2">帯広市特定事業所、試験研究施設の新設・増設に対する助成</p>
                        <div class="row">
                            <p class="col-sm-6 ">登録機関:北海道 帯広市
                            </p>
                            <p class="col-sm-6 ">更新日:</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                    <strong>提案を検討</strong>
                                </button>
                                <p class="customtooltipclass">お気に入りボタンの１つで、より興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                                </div>
                                <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                    <strong>興味あり</strong>
                                    </button>
                                    <p class="customtooltipclass">お気に入りボタンの１つで、興味がある施策を保存しておくことができます。興味がある施策を保存しておくことで、自動検索でよりあなたに合った施策が提案されます。</p>
                                </div>
                                <div class="tooltips"><button type="button" class="btn btn-default btn-style-grey">
                                    <strong>非表示</strong>
                                    </button>
                                    <p class="customtooltipclass">必要がない、自分に関係がない施策が表示された場合は、非表示としてください。非表示とすることで自動検索であなたに関連しない施策が表示されなくなります。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row font17">
                        <p class="h1-left-border"><b>目的</b></p>
                        <p class=" text1">帯広市企業立地促進条例は、帯広市内に工場などを新設・増設する場合に各種助成を行うことで、企業立地を促進し、これにより産業振興をはかることを目的に制定されました。</p>
                    </div>
                    <div class="row font17">
                        <p class="h1-left-border"><b>対象者の詳細</b></p>
                        <p class=" text1">【対象業種】<br>・特定事業所<br>・試験研究施設 <br><br>【要件】<br>＜新設＞<br>投資額：２千万円以上<br>雇用増：５人以上 <br><br>＜増設＞<br>投資額：１千万円以上<br>雇用増：３人以上 <br><br>※雇用増に対する助成は、新規雇用者のうち帯広市内に居住する者のみ。</p>
                    </div>
                    <div class="row font17">
                        <p class="h1-left-border"><b>支援内容</b></p>
                        <p class=" text1">【助成額】<br>投資額の８％<br>10 万円(15 万円)/人<br><br>【限度額】<br>投資額分：１億円<br>雇用増分：５千万円</p>
                    </div>
                    <div class="row font17">
                        <p class="h1-left-border"><b>支援規模</b></p>
                        <div class="col-sm-12 mgt-20 mb20">
                            <div class="row">
                                <div class="col-sm-4 box-line">
                                    <div class="row">
                                        <p class="text1" >下限</p>
                                    </div>
                                    <div class="row">
                                        <p class="form-control ">0</p>
                                    </div>
                                </div>
                                <div class="col-sm-4 box-line">
                                    <div class="row">
                                        <p class="text1" >上限</p>
                                    </div>
                                    <div class="row">
                                        <p class="form-control ">100000000</p>
                                    </div>
                                </div>
                                <div class="col-sm-4 box-line">
                                    <div class="row">
                                        <p class="text1">助成率</p>
                                    </div>
                                    <div class="row">
                                        <p class="form-control ">8%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p >【助成額】<br>投資額の８％<br>10 万円(15 万円)/人<br><br>【限度額】<br>投資額分：１億円<br>雇用増分：５千万円</p>
                    </div>
                    <div class="row font17">
                        <p class="h1-left-border"><b>対象地域</b></p>
                        <p class=" text1">全国</p>
                    </div>
                    <div class="row font17">
                        <p class="h1-left-border"><b>掲載終了日</b></p>
                        <p class=" text1">随時</p>
                    </div>
                    <div class="row font17 mb20 mgt-20">
                        <p class="h1-left-border"><b>pdfデータ</b></p>
                        <p>
                            <a href="#" class="aline">さいたま市中小企業融資制度のご案内</a>
                            <a href="#" class="aline">さいたま市融資制度のご案内</a>
                            <a href="#" class="aline">申込みに必要な書類と部数一覧表</a>
                        </p>
                    </div>
                    <div class="row font17">
                        <p class="h1-left-border"><b>お問い合せ</b></p>
                        <p class=" text1">帯広市商工観光部工業労政課<br>
                            所在：〒080-8670　帯広市西5条南7丁目1<br>
                            電話：0155-65-4167(直通)<br>
                            FAX：0155-23-0172</p>
                    </div>
                </div>

			</div>
		</div>
        
	</div>
</div>
<?php include ('../inc/footer.php'); ?>