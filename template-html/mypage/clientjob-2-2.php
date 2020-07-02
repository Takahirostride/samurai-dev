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
                    </div>
                    <div class="col-sm-12">
                        <form action="" method="POST">
                            <table class="table table-bordered mgbt-0">
                                <tbody>
                                    <tr>
                                        <td class="paddingnone">
                                            <div class="showmesscontent">
                                                <table class="full-width">
                                                    <tbody>
                                                        <tr style="">
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                    <h5 class="text-center col-sm-4">
                                                                        <b>2018年09月06日</b>
                                                                    </h5>
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                                <h5>テスト:</h5>
                                                                <p>test</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                    <h5 class="text-center col-sm-4">
                                                                        <b>2018年09月06日</b>
                                                                    </h5>
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                                <h5>テスト:</h5>
                                                                <p>test</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                    <h5 class="text-center col-sm-4">
                                                                        <b>2018年09月18日</b>
                                                                    </h5>
                                                                    <div class="col-sm-4">
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                                <h5>テスト:</h5>
                                                                <p>test</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table><!-- end table -->
                                            </div><!-- end .showmesscontent -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <hr>
                                                </div>
                                                <h5 class="text-center col-sm-4">
                                                    <b>2018年09月06日</b>
                                                </h5>
                                                <div class="col-sm-4">
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="subjectmes">
                                                <label class="control-label">
                                                    <img src="assets/images/messagesend.png">
                                                </label>
                                                <b></b>
                                                <div class="pull-right">
                                                    <label for="files"><span for="files" class="glyphicon glyphicon-paperclip"></span></label>
                                                    <input class="sr-only" type="file" name="file" id="files">
                                                </div>
                                            </div>
                                            <textarea name="mess" class="form-control messtextinput" rows="6" required="required"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table><!-- end table -->
                            <ul class="nav nav-tabs tablinksub marginnone bordernone">
                                <li class="active">
                                    <a href="#">添付ファイル</a>
                                </li>
                            </ul><!-- end .tablinksub -->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="file" name="file">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button class="shadowbuttondanger btn btn-danger">削除する</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table><!-- end table -->
                            <div class="text-center mgt-30 mgbt-50">
                                <button class="shadowbuttonsuccess btn btn-success">削除する</button>
                            </div>
                        </form>
                    </div><!-- end .col-sm-9 -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('../inc/footer.php'); ?>