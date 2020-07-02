<?php include ('../inc/header.php'); ?>
<div class="mainpage">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li><a class="bg-color" href="#">TOPページ</a></li>
					<li class="active">プロフィール</li>
				</ol>	
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">プロフィール</h1>
				<p class="page-description">プロフィールを詳細に記載していると、通常より申請が4倍通りやすくなる傾向があります。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2 sidebar-left">
				<?php include ('../inc/mypage-sidebar-left.php'); ?>
			</div>
			<div class="col-sm-8 mainpage">
				<div class="row">
					<div class="col-sm-12">
						<div class="profile-av">
							<div class="row">
								<div class="col-sm-4">
									<img class="profile-user-avatar" src="assets/images/avatar.png">
								</div>
								<div class="col-sm-8">
									<h4 class="main-user-name">山田太郎（企業）</h4>
									<p class="main-user-id">ユーザーID：115</p>
									<p class="main-user-total-job">実績：　4件</p>
									<div class="star-rating">
										<select id="example-fontawesome" name="rating" autocomplete="off">
						                	<option value="1">1</option>
						                	<option value="2">2</option>
						                	<option value="3">3</option>
						                	<option value="4">4</option>
						                	<option value="5">5</option>
						                </select>
								  </div>
								</div>
							</div>
						</div> <!-- end .profile-av -->
					</div>	<!-- end middle page -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<ul class="tab-profile nav nav-tabs nav-justified">
							<li class="tab-style-grey"><a href="mypage/clientprofile-1.php"> <img src="assets/images/manual.png" alt="">プロフィール</a></li>
							<li class="tab-style-grey  active"><a href="mypage/clientprofile-3.php"><img src="assets/images/manual.png" alt=""> 希望内容 </a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-5.php">評価・実績</a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-6.php">募集案件</a></li>
							<li class="tab-style-grey"><a href="mypage/clientprofile-7.php"><img src="assets/images/manual.png" alt="">費用</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 text-center">
                            <p class="mb20">
							     <a href="mypage/clientprofile-3.php" class="btn-primary btn btn-style-shadow-green btn-success">表示する</a>
                            </p>
					</div>
				</div>
                <form method="post" action="/">
                <div class="row">
                    <div class="col-sm-12 text-center" >
                        <table class="table table-bordered text-left">
                            <tbody>
                                <tr class="">
                                    <td>
                                        <label > <input class="control-label" type="checkbox" aria-hidden="false" checked="checked"> 雇用・人材 
                                        </label>
                                    </td>
                                    <td>
                                        <label > <input class="control-label" type="checkbox" aria-hidden="false"> 経営改善・販路開拓 
                                        </label>
                                    </td>
                                    <td>
                                        <label > <input class="control-label" type="checkbox" aria-hidden="false"> 設備導入・研究開発 
                                        </label>
                                    </td>
                                    <td>
                                        <label > <input class="control-label" type="checkbox" aria-hidden="false" checked="checked"> 創業・起業 
                                        </label>
                                    </td>
                                </tr>
                                <tr class="">
                                    <td>
                                        <label > <input class="control-label" type="checkbox" aria-hidden="false"> 経営環境改善 
                                        </label>
                                    </td>
                                    <td>
                                        <label > <input class="control-label" type="checkbox" aria-hidden="false"> 特許・知的財産 
                                        </label>
                                    </td>
                                    <td>
                                        <label > <input class="control-label" type="checkbox" aria-hidden="false"> 誘致関連 
                                        </label>
                                    </td>
                                    <td>
                                        <label > <input class="control-label ng-hide" type="checkbox" aria-hidden="true">  
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
				<div class="row">
					<p class="col-sm-12">該当する項目にのみチェックを入れてください。「現在」はあなたが現在行っていること。または、今から行っていくことです。 「将来」は、まだ予定段階のことや1年以上先にお考えのことなどです。</p>
				</div>
				<div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered ">
                            <thead class="div-style-blue2">
                                <tr>
                                    <th colspan="2" >雇用・人材</th>
                                    <th class="mw80-sp">チェック</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td class="text-center">Q</td>
                                    <td >従業員の雇用維持を図りたい
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" checked="checked">
                                    </td>
                                </tr>
                                <tr class="">
                                    <td  class="text-center">Q</td>
                                    <td >雇用管理改善、生産性向上を図り、職場定着を促進したい
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" checked="checked">
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="text-center">Q</td>
                                    <td >障碍者の雇用を行う
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" checked="checked">
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="text-center">Q</td>
                                    <td >人材育成教育の計画立て、職業訓練を行いたい
                                        <br>
                                    </td>
                                    <td class="text-center">
                                        <input type="checkbox" checked="checked">
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="text-center" >Q</td>
                                    <td >有期契約労働者、パート・アルバイト、派遣労働者の正規転換やスキルアップ、昇給等を行いたい
                                        <br>
                                    </td>
                                    <td class="text-center" >
                                        <input type="checkbox" checked="checked">
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="text-center" >Q</td>
                                    <td >高年齢者や障害者等の就職困難者を継続雇用したい
                                        <br>
                                    </td>
                                    <td class="text-center" >
                                        <input type="checkbox" checked="checked">
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="text-center" >Q</td>
                                    <td >事業規模の縮小などにより離職する労働者の再就職支援を行いたい
                                        <br>
                                    </td>
                                    <td class="text-center" >
                                        <input type="checkbox" checked="checked">
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="text-center" >Q</td>
                                    <td >就職が困難な求職者を一定期間試行雇用する
                                        <br>
                                    </td>
                                    <td class="text-center" >
                                        <input type="checkbox" >
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="text-center" >Q</td>
                                    <td >求人の少ない地域において雇用の場を増やす
                                        <br>
                                    </td>
                                    <td class="text-center" >
                                        <input type="checkbox" >
                                    </td>
                                </tr>
                                <tr class="">
                                    <td class="text-center" >Q</td>
                                    <td >40歳以上で起業し、計画届の認定を受け、中高年者を新たに雇用する
                                        <br>
                                    </td>
                                    <td class="text-center" >
                                        <input type="checkbox" checked="checked">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center mb20">
                        <input type="submit" name="submit" value="保存する" class="btn-primary btn btn-style-shadow-green btn-success">
                        <!-- xử lý xong trở về clientprofile-3 -->
                    </div>
                </div>
                </form>
			</div>
			<div class="col-sm-2 sidebar-right">
				<?php include ('../inc/mypage-sidebar-right.php'); ?>
			</div>
		</div>
	</div>
</div>
<?php include ('../inc/footer.php'); ?>