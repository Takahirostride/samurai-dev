<?php include ('../../inc/header.php'); ?>
	<div class="site">
	    <header ng-controller="HeaderCtrl" class="ng-scope">
	        <!-- ngInclude: header_path -->
	        <div ng-include="header_path" class="ng-scope" style="">
	            <div class="header ng-scope">
	                <div class="header-top">
	                    <div class="pull-left">
	                        <ul>
	                            <li><a href="admin/master">マスター管理</a></li>
	                            <li class="active"><a href="admin/employee">施策データ管理</a></li>
	                        </ul>
	                    </div>
	                    <div class="pull-right">
	                        <ul>
	                            <li><a href="" class="ng-binding">ログイン者名 &nbsp; &nbsp; administrator</a></li>
	                            <li><a ng-click="logoutuser()">ログアウト</a></li>
	                        </ul>
	                    </div>
	                </div>
	                <div class="header-bottom">
	                    <ul class="navbar" style="margin-bottom:0px;">
	                        <li><a href="admin/employee">TOP</a></li>
	                        <li><a href="admin/employee/balance/sale.php">収支管理</a></li>
	                        <li class="active"><a href="admin/employee/system/advertisement.php">システム管理</a></li>
	                        <li><a href="admin/employee/customerinfo/agencylist.php">顧客情報管理</a></li>
	                        <li><a href="admin/employee/customersupport/inquiry.php">顧客対応管理</a></li>
	                        <li><a href="admin/employee/data/subsidylist.php">施策データ管理</a></li>
	                        <li><a href="admin/employee/other/affiliate.php">その他管理</a></li>
	                        <li><a href="">ver1.0 &nbsp; </a></li>
	                    </ul>
	                </div>

	                <div class="breadcrumb" style="margin-bottom:0px;">
	                    <ul>
	                        <li><a href="">施策データ管理</a><span>&gt;</span></li>
	                        <li><a>システム管理</a></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </header>

	    <!-- ngView: -->
	    <div ng-view="" class="ng-scope" style="">
		    <div class="content ng-scope">
		        <div class="inner-content">
		            <div class="inner-container">
		                <div class="row">
		                    <div class="col-md-3 pull-left">
		                        <div class="sidebar-left">
		                            <ul>
		                                <li><a href="admin/employee/system/advertisement.php">広告表示管理</a></li>
		                                <li><a href="admin/employee/system/uservoice.php">利用者の声</a></li>
		                                <li><a href="admin/employee/system/alim.php">お知らせ</a></li>
		                                <li><a href="admin/employee/system/suggest.php">おススメの助成金</a></li>
		                                <li><a href="admin/employee/system/industry.php">業種</a></li>
		                                <li><a href="admin/employee/system/tag.php">タグ管理</a></li>
		                                <li><a href="admin/employee/system/category.php">カテゴリー管理</a></li>
		                                <li><a href="admin/employee/system/question.php">企業情報質問内容管理</a></li>
		                                <li><a href="admin/employee/system/payinfo.php">有料情報管理</a></li>
		                                <li class="active"><a href="admin/employee/system/notification.php">通知管理</a></li>
		                                <li><a href="admin/employee/system/blog.php">ブログ管理</a></li>
		                            </ul>
		                        </div>
		                    </div>
		                    <div class="col-md-9 pull-right">
		                        <div class="site-content">
		                            <div class="blueheading"><span>通知設定管理</span></div>

		                            <div class="section-3 col-md-12" style="padding-left:0px;">
		                                <div class="section3-full" style="padding-left:0px;">
		                                    <div class="section3-full-scroll" style="padding-left:8px;">
		                                        <div class="row">
		                                            <div class="col-sm-3">
		                                                <div class="angularsl">
	                                                        <select name="location"> 
	                                                            <option value="1">すべて</option>
																<option value="2">【SAMURAI】新規会員登録を完了してください</option>
																<option value="3">【SAMURAI】会員登録完了のお知らせ</option>
																<option value="4">登録・一般</option>
																<option value="5">【SAMURAI】お問い合わせを受け付けました</option>
																<option value="6">マッチング関連</option>
																<option value="7">仕事管理</option>
																<option value="8">支払管理</option>
	                                                        </select>
	                                                    </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>

		                            <div class="section-6 col-md-12">
		                                <table>
		                                    <thead>
		                                        <tr>
		                                            <th></th>
		                                            <th style="width:30%">項目名</th>
		                                            <th>件名</th>
		                                            <th style="width:40%">本文</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                        <!-- ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="odd" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0" style="">
		                                            <td></td>
		                                            <td class="ng-binding">新規登録された場合（無料登録）</td>
		                                            <td class="ng-binding">【SAMURAI】新規会員登録を完了してください</td>
		                                            <td class="ng-binding">この度は 【助成金・補助金マッチングシステムSAMURAI】 新規会員登録にお申込みいただきまして誠にありがとうございます。 メールアドレス確認のため、 以下のURLを開いて登録の完了をお願いいたします。 https://xxxxxxxxxxxxxxxxx ※上記URLの有効期限は、発行から1時間です。期限内にご登録を完了ください。 上記URLでエラーは発生した場合や、 有効期限が切れてしまった場合は 再度下記URLより仮登録をお願いいたします。 https://samurai-match.jp/register 本メールはこれからSAMURAIをご利用される方に自動送信しております。 お心当たりのない方は、このメールを破棄してください。 ご不明な点やご質問などございましたら、 お気軽に下記運営事務局までお問合せください。 それでは、今後ともSAMURAIをどうぞよろしくお願いいたします。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 【SAMURAI運営事務局】 　〒150-0036 　東京都渋谷区南平台町3-13　新堀ビル3F 【お問合せ先】 　https://samurai-match.jp/inquiry ※原則として、2営業日以内に返信いたします。 ※土日祝日はお時間をいただく場合があります。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 　このメールの送信アドレスは送信専用です。 　ご返信頂きましても内容にはお答えできませんのでご注意ください。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
		                                            </td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0" style="">
		                                            <td></td>
		                                            <td class="ng-binding">会員認証メール</td>
		                                            <td class="ng-binding">【SAMURAI】会員登録完了のお知らせ</td>
		                                            <td class="ng-binding">SAMURAI運営事務局です。 この度は 【助成金・補助金マッチングシステムSAMURAI】 にご登録いただきまして誠にありがとうございます。 会員登録の認証が正常に行われました。 助成金・補助金マッチングシステムをご利用いただくためには、 プロフィールの設定が必要となります。 早速下記からログインし、プロフィールの登録を行ってください。 https://samurai-match.jp/login 使い方に関してご不明点がございましたら、 下記をご覧くださいませ。 ◆ご利用ガイド https://samurai-match.jp/howtouse 今後ともSAMURAIをどうぞよろしくお願いいたします！ ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 【SAMURAI運営事務局】 　〒150-0036 　東京都渋谷区南平台町3-13　新堀ビル3F 【お問合せ先】 　https://samurai-match.jp/inquiry ※原則として、2営業日以内に返信いたします。 ※土日祝日はお時間をいただく場合があります。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 　このメールの送信アドレスは送信専用です。 　ご返信頂きましても内容にはお答えできませんのでご注意ください。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
		                                            </td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="odd" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0">
		                                            <td></td>
		                                            <td class="ng-binding">会員パスワード再発行</td>
		                                            <td class="ng-binding">登録・一般</td>
		                                            <td class="ng-binding">会員パスワード再発行</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0">
		                                            <td></td>
		                                            <td class="ng-binding">メールアドレスが変更された場合</td>
		                                            <td class="ng-binding">登録・一般</td>
		                                            <td class="ng-binding">※このメールは【助成金・補助金マッチングシステムSAMURAI】マイページのメールアドレス変更にて入力されたメールアドレスに自動送信されています。 　こちらのメールにお心当たりがない場合は、恐れ入りますがそのまま削除をお願いいたします。 いつもSAMURAIをご利用いただき誠にありがとうございます。 ご登録メールアドレスの変更希望を承りました。 下記URLより、新しいメールアドレスの認証手続きを行ってください。 https://xxxxxxxxxxxxxxxxx ※手続きがない場合はメールアドレス変更が完了しません。ご注意ください。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 【SAMURAI運営事務局】 　〒150-0036 　東京都渋谷区南平台町3-13　新堀ビル3F 【お問合せ先】 　https://samurai-match.jp/inquiry ※原則として、2営業日以内に返信いたします。 ※土日祝日はお時間をいただく場合があります。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 　このメールの送信アドレスは送信専用です。 　ご返信頂きましても内容にはお答えできませんのでご注意ください。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
		                                            </td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="odd" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0">
		                                            <td></td>
		                                            <td class="ng-binding">パスワードが変更された場合</td>
		                                            <td class="ng-binding">登録・一般</td>
		                                            <td class="ng-binding">メールアドレスが変更された場合、</td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0">
		                                            <td></td>
		                                            <td class="ng-binding">提案のコツや活用ガイドなどのお知らせ・情報
		                                            </td>
		                                            <td class="ng-binding">登録・一般</td>
		                                            <td class="ng-binding"></td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="odd" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0">
		                                            <td></td>
		                                            <td class="ng-binding">お問い合わせを行った場合</td>
		                                            <td class="ng-binding">【SAMURAI】お問い合わせを受け付けました</td>
		                                            <td class="ng-binding">平素よりご愛顧賜り誠にありがとうございます。 SAMURAI運営事務局です。 お問い合わせをいただき誠にありがとうございます。 2営業日中のご返信に努めておりますが、 内容によっては3,4日かかることがございます。 恐縮ではございますがご了承くださいませ。 ※5営業日を超えても連絡がない場合は、 　誠に恐れ入りますが下記事務局宛にご報告をお願いいたします。 この度はお問い合わせをいただき誠にありがとうございました。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 【SAMURAI運営事務局】 　〒150-0036 　東京都渋谷区南平台町3-13　新堀ビル3F 【お問合せ先】 　https://samurai-match.jp/inquiry ※原則として、2営業日以内に返信いたします。 ※土日祝日はお時間をいただく場合があります。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ 　このメールの送信アドレスは送信専用です。 　ご返信頂きましても内容にはお答えできませんのでご注意ください。 ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
		                                            </td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0">
		                                            <td></td>
		                                            <td class="ng-binding">お問い合わせの返信があった場合
		                                            </td>
		                                            <td class="ng-binding">登録・一般</td>
		                                            <td class="ng-binding"></td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="odd" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0">
		                                            <td></td>
		                                            <td class="ng-binding">有料登録を行った場合
		                                            </td>
		                                            <td class="ng-binding">登録・一般</td>
		                                            <td class="ng-binding"></td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                        <tr class="" ng-repeat="tableitem in downedtabledata" ng-click="clickedittableitem($index)" role="button" tabindex="0">
		                                            <td></td>
		                                            <td class="ng-binding">有料登録を解除した場合
		                                            </td>
		                                            <td class="ng-binding">登録・一般</td>
		                                            <td class="ng-binding"></td>
		                                        </tr>
		                                        <!-- end ngRepeat: tableitem in downedtabledata -->
		                                    </tbody>
		                                </table>
		                            </div>
		                            <div class="pagination">
		                                <ul uib-pagination="" total-items="paginationsetting.totalitem" max-size="5" ng-model="paginationsetting.currentpage" previous-text="前へ" next-text="次へ" first-text="最初" last-text="最後" direction-links="false" boundary-links="true" items-per-page="paginationsetting.itemperpage" class="pagination-sm ng-pristine ng-untouched ng-valid ng-isolate-scope pagination ng-not-empty" boundary-link-numbers="true" rotate="true" ng-change="paginationchange()" role="menu" aria-invalid="false">
		                                    <!-- ngIf: ::boundaryLinks -->
		                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noPrevious()||ngDisabled}" class="pagination-first ng-scope disabled"><a href="" ng-click="selectPage(1, $event)" ng-disabled="noPrevious()||ngDisabled" uib-tabindex-toggle="" class="ng-binding" disabled="disabled" tabindex="-1">最初</a></li>
		                                    <!-- end ngIf: ::boundaryLinks -->
		                                    <!-- ngIf: ::directionLinks -->
		                                    <!-- ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope active"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">1</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope" style=""><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">2</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">3</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">4</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">5</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <li role="menuitem" ng-repeat="page in pages track by $index" ng-class="{active: page.active,disabled: ngDisabled&amp;&amp;!page.active}" class="pagination-page ng-scope"><a href="" ng-click="selectPage(page.number, $event)" ng-disabled="ngDisabled&amp;&amp;!page.active" uib-tabindex-toggle="" class="ng-binding">6</a></li>
		                                    <!-- end ngRepeat: page in pages track by $index -->
		                                    <!-- ngIf: ::directionLinks -->
		                                    <!-- ngIf: ::boundaryLinks -->
		                                    <li role="menuitem" ng-if="::boundaryLinks" ng-class="{disabled: noNext()||ngDisabled}" class="pagination-last ng-scope" style=""><a href="" ng-click="selectPage(totalPages, $event)" ng-disabled="noNext()||ngDisabled" uib-tabindex-toggle="" class="ng-binding">最後</a></li>
		                                    <!-- end ngIf: ::boundaryLinks -->
		                                </ul>
		                            </div>
		                            <div class="col-md-12" style="background:#e0dec8;height:18px;margin-top:20px;"></div>
		                            <div class="col-md-12" style="padding-left:50px;padding-right:50px;margin-top:30px;">
		                                <div class="add-container" style "margin-left:0px;margin-right:0px;"="">

		                                    <div class="row">
		                                        <div class="col-md-3" style="background:#fff;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">項目名</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" style="font-size:16px" ng-model="editnotisetting.item_name" aria-invalid="false">
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row">
		                                        <div class="col-md-3" style="background:#fff;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">送信対象</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <div class="col-md-8" style="padding-left:0px;">
		                                                    <div class="angularsl">
		                                                        <select name="location"> 
		                                                            <option value="1">選択</option>
																	<option value="2">事業者</option>
																	<option value="3">士業</option>
																	<option value="4">すべて</option>		
		                                                        </select>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="row">
		                                        <div class="col-md-3" style="background:#fff;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">件名</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <input class="form-control ng-pristine ng-untouched ng-valid ng-empty" type="text" ng-model="editnotisetting.title" aria-invalid="false">
		                                            </div>

		                                        </div>
		                                    </div>
		                                    <div class="row">
		                                        <div class="col-md-3" style="background:#fff;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;">送信元</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right" style="height:40px;">
		                                                <div class="col-md-8" style="padding-left:0px;">
		                                                    <div class="angularsl">
		                                                        <select name="location"> 
		                                                            <option value="1">選択</option>
																	<option value="2">info@samurai-match.jp</option>	
		                                                        </select>
		                                                    </div>
		                                                </div>
		                                            </div>

		                                        </div>
		                                    </div>
		                                    <div class="row">
		                                        <div class="col-md-3" style="height:120px;background:#fff;">
		                                            <div class="gridcell-left">
		                                                <p style="font-size:14px;position: relative;top:40%;">本文</p>
		                                            </div>
		                                        </div>
		                                        <div class="col-md-9">
		                                            <div class="gridcell-right">
		                                                <textarea name="Text1" class="form-control ng-pristine ng-untouched ng-valid ng-empty" style="width:100%;" rows="5" ng-model="editnotisetting.text" aria-invalid="false"></textarea>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>

		                                <div style="margin-top:50px;">
		                                    <input type="submit" name="submit" class="submit-blue-btn" value="保存する" ng-click="submitsavenotidata()" ng-disabled="editnotisetting.id==-1" disabled="disabled">
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
<?php include ('../../inc/footer.php'); ?>
