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
        </div><!-- end .row -->
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">仕事管理</h1>
            </div>
        </div><!-- end .row -->
        <div class="row">
            <div class="col-sm-2 sidebar-left">
                <?php include ('../inc/mypage-sidebar-left.php'); ?>
            </div>
            <div class="col-sm-10 mainpage">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="jobTapLink">
                            <li>
                                <a href="mypage/clientjob-1.php">依頼・提案・募集</a>
                            </li>
                            <li class="active">
                                <a href="mypage/clientjob-2.php">マッチング案件</a>
                            </li>
                            <li>
                                <a href="mypage/clientjob-3.php">終了した案件</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="div-style-grey">
                    <div class="row">
                        <div class="col-sm-4">
                            <h5 class="font13">10/12</h5>
                        </div>
                        <div class="col-sm-8">
                            <form action="" method="POST" class="form-inline text-right">
                                <div class="form-group col-sm-7">
                                    <label class="fw500" for="">表示年月：</label>
                                    <select class="form-control min-w100 mgr-15" name="filteryear">
                                        <option value="0" selected="selected">すべて</option>
                                        <option value="2017">2017年</option>
                                        <option value="2018">2018年</option>
                                        <option value="2019">2019年</option>
                                    </select>
                                    <select class="form-control min-w100" name="filtermonth">
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
                                <div class="form-group col-sm-5">
                                    <label class="fw500" for="">表示件数：</label>
                                    <select class="form-control min-w150" name="itemperpagestring">
                                        <option value="10" selected="selected">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs tablinksub">
                            <li class="active">
                                <a href="mypage/clientjob-2.php">案件一覧</a>
                            </li>
                            <li>
                                <a href="mypage/clientjob-2-5.php">スケジュール</a>
                            </li>
                        </ul>
                    </div>  <!-- end middle page -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="boxpdbg">
                            <table class="table table-bordered table-hover pdtdbold">
                                <thead>
                                    <tr>
                                        <th>タイトル</th>
                                        <th>事業者名</th>
                                        <th>マッチング日</th>
                                        <th>締切日</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>伊勢崎市企業立地促進奨励金（施策名）</td>
                                        <td>テスト</td>
                                        <td>2018年07月26日</td>
                                        <td>0000年00月00日</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-hover pdtdbold">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="pull-left">
                                                <a href="mypage/clientjob-2-1.php" class="shadowbuttonsuccess btn btn-success mgr-8">タスクを見る</a>
                                                <a href="mypage/clientjob-2-2.php" class="shadowbuttonsuccess btn btn-success">メッセージを見る</a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="mypage/clientjob-2-3.php" class="shadowbuttonprimary btn btn-primary mgr-8">請求</a>
                                                <a href="mypage/clientjob-2-4.php" class="shadowbuttonprimary btn btn-primary">完了・キャンセル</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end .col-sm-12 -->   
                    <div class="col-sm-12">
                        <h3 class="page-title">完了・キャンセル通知</h3>
                        <div class="row boxcacular">
                            <div class="col-sm-9">
                                <h5><b>すべての業務が完了した場合、下記の項目にチェックを入れて、終了報告を行なってください。</b></h5>
                                <div class="radio">
                                    <label class="font12">
                                        <input type="radio" name="finishtype" id="optionsRadios1" value="1">取得して終了する
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="font12">
                                        <input type="radio" name="finishtype" id="optionsRadios1" value="1">取得できずに終了する
                                    </label>
                                </div>
                                <div class="radio">
                                    <label class="font12">
                                        <input type="radio" name="finishtype" id="optionsRadios1" value="1">キャンセル
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="cacular-desc">
                                    <p class="text-center mgbt-30">
                                        <span class="boxred">請求済み</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end .col-sm-12 -->   
                    <div class="col-sm-12">
                        <h3 class="page-title">評価</h3>
                        <div class="row boxcacular1">
                            <form action="" method="POST">
                                <div class="col-sm-12">
                                    <h6>士業の評価を行ってください。<br>
                                    ★をクリックすることで星の数を設定して、士業を評価してください。数字を入力して設定することもできます。<br>
                                    入力欄には詳細な評価を記入してください。</h6>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="div-style-blue1 agencyjob-box-star">
                                                <table class="full-width">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>総合評価</b></td>
                                                            <td><span class="font18" id="rating1">5</span></td>
                                                            <td>
                                                                <div class="star-rating bigstar">
                                                                    <select class="datrating" data-ids="rating1" name="rating1" autocomplete="off">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5" selected>5</option>
                                                                    </select>
                                                                </div> <!-- end .star-rating -->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>総合評価</b></td>
                                                            <td><span class="font18" id="rating2">5</span></td>
                                                            <td>
                                                                <div class="star-rating bigstar">
                                                                    <select class="datrating" data-ids="rating2" name="rating2" autocomplete="off">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5" selected>5</option>
                                                                    </select>
                                                                </div> <!-- end .star-rating -->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>総合評価</b></td>
                                                            <td><span class="font18" id="rating3">5</span></td>
                                                            <td>
                                                                <div class="star-rating bigstar">
                                                                    <select class="datrating" data-ids="rating3" name="rating3" autocomplete="off">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5" selected>5</option>
                                                                    </select>
                                                                </div> <!-- end .star-rating -->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="div-style-blue1 agencyjob-box-star">
                                                <table class="full-width">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>総合評価</b></td>
                                                            <td><span class="font18" id="rating4">5</span></td>
                                                            <td>
                                                                <div class="star-rating bigstar">
                                                                    <select class="datrating" data-ids="rating4" name="rating4" autocomplete="off">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5" selected>5</option>
                                                                    </select>
                                                                </div> <!-- end .star-rating -->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>総合評価</b></td>
                                                            <td><span class="font18" id="rating5">5</span></td>
                                                            <td>
                                                                <div class="star-rating bigstar">
                                                                    <select class="datrating" data-ids="rating5" name="rating5" autocomplete="off">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5" selected>5</option>
                                                                    </select>
                                                                </div> <!-- end .star-rating -->
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>総合評価</b></td>
                                                            <td><span class="font18" id="rating6">5</span></td>
                                                            <td>
                                                                <div class="star-rating bigstar">
                                                                    <select class="datrating" data-ids="rating6" name="rating6" autocomplete="off">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5" selected>5</option>
                                                                    </select>
                                                                </div> <!-- end .star-rating -->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <textarea name="content" class="form-control" rows="4"></textarea>
                                    <div class="checkbox">
                                        <label class="font12"><input type="checkbox"><strong>今後、この施策を検索結果に表示させない。</strong></label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="shadowbuttonprimary btn btn-primary">終了報告する</button>
                                    </div>
                                </div>
                            </form>
                            <!-- end form -->
                        </div>
                    </div><!-- end .col-sm-12 -->   
                </div><!-- end .row --> 
            </div><!-- end .mainpage -->
        </div><!-- end .row -->
    </div><!-- end .container -->
</div><!-- end .mainpage -->
<?php include ('../inc/footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change', '.datrating', function(){
            var obj = $(this);
            var id='#'+obj.attr('data-ids');
            var val = obj.val();
            $(id).text(val);
        });
    });
</script>